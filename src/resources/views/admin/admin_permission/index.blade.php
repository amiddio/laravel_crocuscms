<x-admin-app-layout>
    <x-slot name="page_title">{{ __('Admin Permissions') }}</x-slot>

    <x-slot name="content">
        <form method="get" action="{{ route('admin.admin_permissions') }}" class="max-w-sm">
            <div class="mb-6">
                <label for="roles" class="block mb-2 text-gray-900 dark:text-white">{{ __('Select a role') }}</label>
                <select id="roles" name="role_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="0">---</option>
                    @foreach($roles as $id=>$name)
                        <option value="{{ $id }}"
                                @if($name == config('admin.super_admin_role_name')) disabled @endif
                                @if($roleId == $id) selected @endif
                        >{{ $name }}</option>
                    @endforeach
                </select>
            </div>
            <x-admin.button-primary :label="__('Select')"/>
        </form>

        @if($roleId && $allAdminRoutes)
            <hr class="my-12 h-0.5 border-t-0 bg-neutral-100 dark:bg-white/10" />

            <h5 class="mb-6 mt-0 text-xl font-medium leading-tight">
                {{ __('Admin Routes List') }}
            </h5>

            <form method="post" action="{{ route('admin.admin_permissions.update', $roleId) }}">
                @csrf
                @method('patch')

                @foreach($allAdminRoutes as $item)
                    <div class="mb-4 block min-h-[1.5rem] ps-[1.5rem]">
                        <input
                            class="relative float-left -ms-[1.5rem] me-[6px] mt-[0.15rem] h-[1.125rem] w-[1.125rem] appearance-none rounded-[0.25rem] border-[0.125rem] border-solid border-secondary-500 outline-none before:pointer-events-none before:absolute before:h-[0.875rem] before:w-[0.875rem] before:scale-0 before:rounded-full before:bg-transparent before:opacity-0 before:shadow-checkbox before:shadow-transparent before:content-[''] checked:border-primary checked:bg-primary checked:before:opacity-[0.16] checked:after:absolute checked:after:-mt-px checked:after:ms-[0.25rem] checked:after:block checked:after:h-[0.8125rem] checked:after:w-[0.375rem] checked:after:rotate-45 checked:after:border-[0.125rem] checked:after:border-l-0 checked:after:border-t-0 checked:after:border-solid checked:after:border-white checked:after:bg-transparent checked:after:content-[''] hover:cursor-pointer hover:before:opacity-[0.04] hover:before:shadow-black/60 focus:shadow-none focus:transition-[border-color_0.2s] focus:before:scale-100 focus:before:opacity-[0.12] focus:before:shadow-black/60 focus:before:transition-[box-shadow_0.2s,transform_0.2s] focus:after:absolute focus:after:z-[1] focus:after:block focus:after:h-[0.875rem] focus:after:w-[0.875rem] focus:after:rounded-[0.125rem] focus:after:content-[''] checked:focus:before:scale-100 checked:focus:before:shadow-checkbox checked:focus:before:transition-[box-shadow_0.2s,transform_0.2s] checked:focus:after:-mt-px checked:focus:after:ms-[0.25rem] checked:focus:after:h-[0.8125rem] checked:focus:after:w-[0.375rem] checked:focus:after:rotate-45 checked:focus:after:rounded-none checked:focus:after:border-[0.125rem] checked:focus:after:border-l-0 checked:focus:after:border-t-0 checked:focus:after:border-solid checked:focus:after:border-white checked:focus:after:bg-transparent rtl:float-right dark:border-neutral-400 dark:checked:border-primary dark:checked:bg-primary"
                            type="checkbox"
                            name="routes[]"
                            @if(in_array($item->id, $relatedPermissions)) checked @endif
                            value="{{ $item->id }}" />
                        <label class="inline-block ps-[0.15rem] hover:cursor-pointer">{{ $item->route }} [{{ Str::of($item->method)->upper() }}]</label>
                    </div>
                @endforeach
                <x-admin.button-primary :label="__('Save')"/>
            </form>
        @endif

    </x-slot>
</x-admin-app-layout>
