<x-admin-app-layout>
    <x-slot name="page_title">{{ __('Page \':page\' Edit', ['page' => $page->name]) }}</x-slot>

    <x-slot name="content">

        <div class="text-right space-x-4">
            <a
                href="{{ url()->previous() }}"
                class="text-secondary transition duration-150 ease-in-out hover:text-secondary-600 focus:text-secondary-600 active:text-secondary-700"
            >{{ __('Back') }}</a>
            <a
                href="{{ route('admin.pages.index') }}"
                class="text-secondary transition duration-150 ease-in-out hover:text-secondary-600 focus:text-secondary-600 active:text-secondary-700"
            >{{ __('List') }}</a>
            <a
                href="{{ route('admin.pages.create') }}"
                class="text-primary transition duration-150 ease-in-out hover:text-primary-600 focus:text-primary-600 active:text-primary-700 dark:text-primary-400 dark:hover:text-primary-500 dark:focus:text-primary-500 dark:active:text-primary-600"
            >{{ __('Create') }}</a>
            <a
                href="#!"
                class="text-danger transition duration-150 ease-in-out hover:text-danger-600 focus:text-danger-600 active:text-danger-700"
                data-twe-toggle="modal"
                data-twe-target="#deletePage"
            >{{ __('Delete') }}</a>
        </div>
        <hr class="mt-3 mb-6" />

        <form method="post" action="{{ route('admin.pages.update', $page->id) }}">
            @csrf
            @method('put')
            <x-admin.input-row type="text" :name="'name'" :label="__('Name')" :value="old('name', $page->name)" :required="true" autofocus />
{{--            <x-admin.input-row type="text" :name="'title'" :label="__('Title')" :value="old('title', $page->title)" :required="true" />--}}
{{--            <x-admin.textarea-row :name="'intro'" :label="__('Intro')" :value="old('intro', $page->intro)" :rows="'3'" />--}}
{{--            <x-admin.textarea-row :name="'content'" :label="__('Content')" :value="old('content', $page->content)" :rows="'10'" />--}}
            <x-admin.checkbox :name="'is_active'" :label="__('Is active?')" :checked="old('is_active', (bool)$page->is_active)" />

            <ul
                class="mb-5 flex list-none flex-row flex-wrap border-b-0 ps-0"
                role="tablist"
                data-twe-nav-ref>
                @foreach(config('translatable.locales') as $locale)
                    <li role="presentation">
                        <a
                            href="#tabs-locale-{{ $locale }}"
                            class="my-2 block border-x-0 border-b-2 border-t-0 border-transparent px-7 pb-3.5 pt-4 text-xs font-medium uppercase leading-tight text-neutral-500 hover:isolate hover:border-transparent hover:bg-neutral-100 focus:isolate focus:border-transparent data-[twe-nav-active]:border-primary data-[twe-nav-active]:text-primary dark:text-white/50 dark:hover:bg-neutral-700/60 dark:data-[twe-nav-active]:text-primary"
                            data-twe-toggle="pill"
                            data-twe-target="#tabs-locale-{{ $locale }}"
                            role="tab"
                            aria-controls="tabs-locale-{{ $locale }}"
                            @if(app()->getLocale() == $locale) aria-selected="true" data-twe-nav-active @else aria-selected="false" @endif
                        >{{ Str::of($locale)->upper() }}</a>
                    </li>
                @endforeach
            </ul>
            <!--Tabs content-->
            <div class="mb-6">
                @foreach(config('translatable.locales') as $locale)
                    <div
                        class="hidden opacity-100 transition-opacity duration-150 ease-linear data-[twe-tab-active]:block"
                        id="tabs-locale-{{ $locale }}"
                        role="tabpanel"
                        aria-labelledby="tabs-locale-{{ $locale }}-tab"
                        @if(app()->getLocale() == $locale) data-twe-tab-active @endif
                    >
                        <x-admin.input-row type="text" :name="'title:'.$locale" :label="__('Title')" :value="old('title:'.$locale, $translates[$locale]['title'])" :required="false" />
                        <x-admin.textarea-row :name="'intro:'.$locale" :label="__('Intro')" :value="old('intro:'.$locale, $translates[$locale]['intro'])" :rows="'3'" />
                        <x-admin.textarea-row :name="'content:'.$locale" :label="__('Content')" :value="old('content:'.$locale, $translates[$locale]['content'])" :rows="'10'" />
                    </div>
                @endforeach
            </div>

            <x-admin.button-primary :label="__('Save')"/>
        </form>

        <x-admin.modal :id="'deletePage'" :title="__('Delete Page')" :button="'Delete'">
            <form method="post" action="{{ route('admin.pages.destroy', $page->id) }}" id="deletePage-form">
                @csrf
                @method('delete')
                <p>
                    {{ __('Are you sure you want to delete page \':page\'?', ['page' => $page->name]) }}
                </p>
            </form>
        </x-admin.modal>

    </x-slot>
</x-admin-app-layout>
