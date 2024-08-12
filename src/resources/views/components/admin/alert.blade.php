@if(session()->has('message') && session()->has('type'))
    @switch(session()->get('type'))
        @case('success')
            <div class="w-full mb-2 items-center rounded-lg bg-success-100 px-6 py-5 text-base text-success-700 dark:bg-green-950 dark:text-success-500/80" role="alert" id="alert-static-success" data-twe-alert-init="">
            @break
        @case('error')
            <div class="w-full mb-2 items-center rounded-lg bg-danger-100 px-6 py-5 text-base text-danger-700 dark:bg-[#2c0f14] dark:text-danger-500" role="alert" id="alert-static-danger" data-twe-alert-init="">
            @break
        @case('info')
            <div class="w-full mb-2 items-center rounded-lg bg-info-100 px-6 py-5 text-base text-info-800 dark:bg-[#11242a] dark:text-info-500" role="alert" id="alert-static-info" data-twe-alert-init="">
            @break
    @endswitch
        {{ session()->get('message') }}
    </div>
@endif
