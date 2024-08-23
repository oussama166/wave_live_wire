<section
    class="max-w-[77vw] w-full max-h-[80px] h-full flex justify-between mt-10 px-10  fixed top-10 z-10"
    id="header"
>
    {{--  THIS IS FOR THE   --}}
    <div id="header-info" class="flex flex-col gap-1 py-2">
        <div class="text-sm font-normal tracking-wide text-wave-disable">
            <h1>{{ parse_url($path)['path'] }}</h1>

        </div>
        <div class="text-4xl font-semibold tracking-wide text-wave-primary">
            <h1>{{ $title }}</h1>
        </div>
    </div>

    {{-- THIS IS FOR THE USER INFORMATION AS NOTIFICATION / BALANCE / USER NAME INFO / LOGOUT --}}
    <div id="header-user" class="flex items-center gap-5">
        {{-- > Notification --}}
        <div
            class="max-w-2xl relative p-3 bg-white rounded-full cursor-pointer"
            x-data="{
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
            }"
            x-init="
                that = this;
                window.addEventListener('resize', function(){
                    popoverPositionCalculate();
                });
                $watch('popoverOpen', function(value){
                    if(value){ popoverPositionCalculate(); document.getElementById('width').focus();  }
                });
            "

        >
            <x-phosphor-bell-simple-fill class="w-6 text-[#aab4d4]" @click="popoverOpen=!popoverOpen"/>
            @if(auth()->user()->unreadNotifications->all() != [])
                <span class="sr-only">Notifications</span>
                <div
                    class="absolute inline-flex items-center justify-center w-6 h-6 text-xs font-bold text-white bg-red-500 border-2 border-white rounded-full top-1 end-0 dark:border-gray-900">
                    +{{count(auth()->user()->unreadNotifications->all())}}</div>
            @endif
            <div x-ref="popover"
                 x-show="popoverOpen"
                 x-init="setTimeout(function(){ popoverHeightCalculate(); }, 100);"
                 x-trap.inert="popoverOpen"
                 @click.away="popoverOpen=false;"
                 @keydown.escape.window="popoverOpen=false"
                 :class="{ 'top-0 mt-12' : popoverPosition == 'bottom', 'bottom-0 mb-12' : popoverPosition == 'top' }"
                 class="absolute w-[700px]  max-w-lg -translate-x-1/2 left-1/2" x-cloak>
                <div x-ref="popoverInner" x-show="popoverOpen"
                     class=" w-full  bg-white border rounded-md shadow-sm border-neutral-200/70 overflow-hidden">
                    <div x-show="popoverArrow && popoverPosition == 'bottom'"
                         class="absolute top-0 inline-block w-5 mt-px overflow-hidden -translate-x-2 -translate-y-2.5 left-1/2">
                        <div
                            class="w-2.5 h-2.5 origin-bottom-left transform rotate-45 bg-primary-600 border-t border-l rounded-sm"></div>
                    </div>
                    <div x-show="popoverArrow  && popoverPosition == 'top'"
                         class="absolute bottom-0 inline-block w-5 mb-px overflow-hidden -translate-x-2 translate-y-2.5 left-1/2">
                        <div
                            class="w-2.5 h-2.5 origin-top-left transform -rotate-45 bg-primary-600 border-b border-l rounded-sm"></div>
                    </div>
                    <div class="grid gap-4">
                        <div
                            class="space-x-2 bg-primary-600 text-white inline-flex flex-nowrap items-center justify-center p-4">
                            <h4 class="capitalize font-semibold leading-none text-nowrap">Your notifications</h4>
                            <div
                                class="py-2 px-3 font-semibold text-sm text-center text-nowrap bg-white text-primary-500 rounded-lg">
                                {{count(auth()->user()->unreadNotifications->all())}} New
                            </div>
                            <hr class="w-full  h-0 bg-transparent">
                            <h4 class="py-2 px-3 font-semibold text-sm text-center text-nowrap bg-white text-primary-500 rounded-lg inline-flex flex-nowrap gap-1">
                                Clear All
                                <x-phosphor-x-circle-fill class="w-5 h-5"/>
                            </h4>
                        </div>
                        <div class="grid gap-2">
                            @forelse(auth()->user()->Notifications->all() as $notification)
                                <div class="w-full inline-flex justify-between items-start px-5 my-3">
                                    <div class="flex flex-col">
                                        <h1 class="w-full text-sm font-semibold font-Mulish">{{$notification->data['message']}}</h1>
                                        <p class="w-full text-sm text-wave-disable">{{timeAgo($notification->created_at)}}</p>
                                    </div>
                                    @if($notification)
                                    <x-phosphor-check-circle-light class="h-5 w-5" wire:click="{{$notification->markAsRead()}}"/>

                                    @endif
                                </div>
                            @empty
                                <h1 class="w-full text-center text-wave-disable">No Unread Notifications</h1>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Notification < --}}

        <div class="p-4 bg-white rounded-full">
            <span
                class="text-[#aab4d4]  inline-block relative pe-8 last:pe-0 last-of-type:before:hidden before:absolute before:top-1/2 before:end-3 before:-translate-y-1/2 before:w-px before:h-6 before:bg-gray-300 before:rounded-sm dark:text-neutral-400 dark:before:bg-neutral-600">
                {{ $balance }} Balance
            </span>
            <span class="text-black/40">{{ $name }}</span>
        </div>

        <form method="POST" wire:submit='logout'>
            @csrf
            <button type="submit" class="flex items-center justify-center p-3 bg-white rounded-full cursor-pointer">
                <x-tabler-logout class="w-5 text-[#aab4d4] text-lg"/>
            </button>
        </form>
    </div>


    <script>
        document.addEventListener("DOMContentLoaded", () => {

            InitGsap();
        });
    </script>
</section>
