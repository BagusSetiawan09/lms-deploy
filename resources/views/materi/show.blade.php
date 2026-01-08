<x-app-layout>
    <div class="flex items-center flex-col">
        @php
            $firstVideoId = $parts[0]->video_id ?? '';
        @endphp

        <div class="w-[1200px] min-h-[600px] rounded-xl bg-gradient-to-t from-[#33A1D9] to-[#fff] flex items-start justify-start"
            x-data="videoPlayer()" x-init="init('{{ $firstVideoId }}')">

            {{-- Video Player --}}
            <div id="mainPlayer" class="w-[800px] h-[480px] rounded-xl shadow mt-10 ml-6"></div>

            {{-- Video List --}}
            <div class="ml-5 mt-10 bg-gray-100 w-[320px] h-[480px] flex flex-col items-center rounded-lg overflow-y-auto shadow">
                <div class="space-y-2 py-5 text-sm w-full px-2">
                   @foreach ($parts as $index => $part)
                        @php
                            $prevIndex = $index - 1;
                        @endphp
                        <button
                            class="w-[300px] py-3 rounded-md text-left px-3  text-[15px]"
                            x-bind:class="seenParts.includes({{ $prevIndex }}) || {{ $index }} === 0 
                                ? (selectedIndex === {{ $index }} 
                                    ? 'bg-blue-600 text-white' 
                                    : 'bg-blue-300 hover:bg-blue-500') 
                                : 'bg-gray-300 text-gray-500 cursor-not-allowed'"
                            x-bind:disabled="!seenParts.includes({{ $prevIndex }}) && {{ $index }} !== 0"
                            @click="changeVideo('{{ $part->video_id }}', {{ $index }})"
                        >
                            {{ $part->title }}
                            @if ($videoProgress[$part->video_id] ?? 0)
                                ✅
                            @endif
                        </button>
                    @endforeach
                </div>
            </div>

        </div>

        {{-- Tambahkan skrip YouTube --}}
        <script>
            const tag = document.createElement('script');
            tag.src = "https://www.youtube.com/iframe_api";
            const firstScriptTag = document.getElementsByTagName('script')[0];
            firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

            function videoPlayer() {
                return {
                    selectedUrl: '',
                    selectedIndex: 0,
                    seenParts: [],
                    player: null,
                    interval: null,

                    async changeVideo(videoId, index) {
                        const maxSeen = Math.max(...this.seenParts, -1);
                        if (index <= maxSeen + 1) {
                            this.selectedIndex = index;
                            this.selectedUrl = videoId;

                            const progress = await this.fetchProgress(videoId);

                            // Hentikan video sebelumnya dan simpan progresnya
                            if (this.player && this.player.getPlayerState() === YT.PlayerState.PLAYING) {
                                const currentTime = this.player.getCurrentTime();
                                this.saveProgress(this.selectedUrl, currentTime);
                            }

                            // Load video baru dan setelah onReady, seek ke progress
                            this.player.loadVideoById({ videoId: videoId, startSeconds: progress });
                            
                            // Tunggu hingga video siap
                            const waitUntilReady = () => {
                                if (this.player.getPlayerState() !== -1) { // -1 = unstarted
                                    this.player.loadVideoById({ videoId: videoId, startSeconds: progress });
                                } else {
                                    setTimeout(waitUntilReady, 300);
                                }
                            };
                            waitUntilReady();
                        }
                    },

                    markSeen() {
                        if (!this.seenParts.includes(this.selectedIndex)) {
                            this.seenParts.push(this.selectedIndex);
                        }
                    },

                    fetchProgress(videoId) {
                        return fetch(`/video-progress/${videoId}`)
                            .then(res => res.json())
                            .then(data => Math.floor(data.progress || 0))
                            .catch(() => 0);
                    },

                    saveProgress(videoId, currentTime) {
                        if (!videoId || currentTime <= 1.0) return;
                        console.log('Saving progress:', videoId, currentTime);
                        fetch('/video-progress', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').getAttribute('content')
                            },
                            body: JSON.stringify({
                                video_id: videoId,
                                progress: currentTime
                            })
                        });
                    },

                    initPlayer(videoId) {
                        this.player = new YT.Player('mainPlayer', {
                            videoId: videoId,
                            events: {
                                onReady: async (event) => {
                                    const progress = await this.fetchProgress(videoId);
                                    event.target.seekTo(progress, true);
                                },
                                onStateChange: (event) => {
                                    const currentVideoId = this.selectedUrl;

                                    if (event.data === YT.PlayerState.PLAYING) {
                                        if (this.interval) clearInterval(this.interval);
                                        this.interval = setInterval(() => {
                                            const currentTime = this.player.getCurrentTime();
                                            this.saveProgress(currentVideoId, currentTime);
                                        }, 2000);
                                    }

                                    if (event.data === YT.PlayerState.ENDED) {
                                        this.markSeen();
                                        this.saveProgress(currentVideoId, this.player.getDuration());
                                        if (this.interval) clearInterval(this.interval);

                                        // Kirim status selesai ke server
                                        fetch("/api/video-progress/complete", {
                                            method: "POST",
                                            headers: {
                                                "Content-Type": "application/json",
                                                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
                                            },
                                            body: JSON.stringify({
                                                video_id: currentVideoId,
                                            }),
                                        });
                                    }

                                    if (event.data === YT.PlayerState.PAUSED) {
                                        const currentTime = this.player.getCurrentTime();
                                        this.saveProgress(currentVideoId, currentTime);
                                    }
                                }

                            }
                        });
                    },

                    init(videoId) {
                        this.selectedUrl = videoId;

                        // Inisialisasi seenParts dari data server Laravel (isi dari $videoProgress)
                        this.seenParts = [
                            @foreach ($parts as $i => $p)
                                @if ($videoProgress[$p->video_id] ?? false)
                                    {{ $i }},
                                @endif
                            @endforeach
                        ];

                        window.onYouTubeIframeAPIReady = () => {
                            this.initPlayer(videoId);
                        };
                        if (window.YT && window.YT.Player) {
                            this.initPlayer(videoId);
                        }
                    }

                }
            }
        </script>
    </div>
</x-app-layout>
