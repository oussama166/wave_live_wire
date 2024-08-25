<div wire:poll.750ms class="relative max-w-2xl p-3 bg-white rounded-full cursor-pointer" x-data="{
                popoverOpen: false,
                popoverArrow: true,
                popoverPosition: 'bottom',
                popoverHeight: 0,
                popoverOffset: 8,
                popoverHeightCalculate() {
                    this.$refs.popover.classList.add('invisible');
                    this.popoverOpen=true;
                    let that=this;
                    $nextTick(function(){
                        that.popoverHeight = that.$refs.popover.offsetHeight;
                        that.popoverOpen=false;
                        that.$refs.popover.classList.remove('invisible');
                        that.$refs.popoverInner.setAttribute('x-transition', '');
                        that.popoverPositionCalculate();
                    });
                },
                popoverPositionCalculate(){
                    if(window.innerHeight < (this.$refs.popoverButton.getBoundingClientRect().top + this.$refs.popoverButton.offsetHeight + this.popoverOffset + this.popoverHeight)){
                        this.popoverPosition = 'top';
                    } else {
                        this.popoverPosition = 'bottom';
                    }
                }
            }" x-init="
                that = this;
                window.addEventListener('resize', function(){
                    popoverPositionCalculate();
                });
                $watch('popoverOpen', function(value){
                    if(value){ popoverPositionCalculate(); document.getElementById('width').focus();  }
                });
            ">
    <x-phosphor-bell-simple-fill class="w-6 text-[#aab4d4]" @click="popoverOpen=!popoverOpen" />
    @if(auth()->user()->unreadNotifications->all() != [])
    <span class="sr-only">Notifications</span>
    <div
        class="absolute inline-flex items-center justify-center text-xs font-bold text-white bg-red-500 border-2 border-white rounded-full w-7 h-7 top-1 -end-1 dark:border-gray-900 text-ellipsis">
        +{{count(auth()->user()->unreadNotifications->all())}}</div>
    @endif
    <div x-ref="popover" x-show="popoverOpen" x-init="setTimeout(function(){ popoverHeightCalculate(); }, 100);"
        x-trap.inert="popoverOpen" @click.away="popoverOpen=false;" @keydown.escape.window="popoverOpen=false"
        :class="{ 'top-0 mt-12' : popoverPosition == 'bottom', 'bottom-0 mb-12' : popoverPosition == 'top' }"
        class="absolute w-[700px]  max-w-lg -translate-x-1/2 left-1/2" x-cloak>
        <div x-ref="popoverInner" x-show="popoverOpen"
            class="w-full overflow-hidden bg-white border rounded-md shadow-sm border-neutral-200/70">
            <div x-show="popoverArrow && popoverPosition == 'bottom'"
                class="absolute top-0 inline-block w-5 mt-px overflow-hidden -translate-x-2 -translate-y-2.5 left-1/2">
                <div
                    class="w-2.5 h-2.5 origin-bottom-left transform rotate-45 bg-primary-600 border-t border-l rounded-sm">
                </div>
            </div>
            <div x-show="popoverArrow  && popoverPosition == 'top'"
                class="absolute bottom-0 inline-block w-5 mb-px overflow-hidden -translate-x-2 translate-y-2.5 left-1/2">
                <div
                    class="w-2.5 h-2.5 origin-top-left transform -rotate-45 bg-primary-600 border-b border-l rounded-sm">
                </div>
            </div>
            <div class="grid gap-4">
                <div
                    class="inline-flex items-center justify-center p-4 space-x-2 text-white bg-primary-600 flex-nowrap">
                    <h4 class="font-semibold leading-none capitalize text-nowrap">Your notifications</h4>
                    <div
                        class="px-3 py-2 text-sm font-semibold text-center bg-white rounded-lg text-nowrap text-primary-500">
                        {{count(auth()->user()->unreadNotifications->all())}} New
                    </div>
                    <hr class="w-full h-0 bg-transparent">
                    <h4
                        class="inline-flex gap-1 px-3 py-2 text-sm font-semibold text-center bg-white rounded-lg text-nowrap text-primary-500 flex-nowrap">
                        Clear All
                        <x-phosphor-x-circle-fill class="w-5 h-5" />
                    </h4>
                </div>
                <div class="grid gap-2 max-h-[400px] overflow-y-scroll">
                    @forelse(auth()->user()->Notifications->all() as $notification)
                    <div class="inline-flex items-start justify-between w-full px-5 my-3">
                        <div class="flex flex-col">
                            <h1 class="w-full text-sm font-semibold font-Mulish">{{$notification->data['message']}}</h1>
                            <p class="w-full text-sm text-wave-disable">{{timeAgo($notification->created_at)}}</p>
                        </div>
                        @if($notification->read_at == null)
                        <x-phosphor-check-circle-light class="w-5 h-5" wire:click="markAsRead({{ $notification }})" />
                        @else
                        <x-phosphor-check-circle-fill class="w-5 h-5 text-green-500" />
                        @endif
                    </div>
                    @empty
                    <div class="inline-flex items-start justify-between w-full px-5 my-3">
                        <h1 class="w-full text-center text-wave-disable">No Notifications</h1>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
