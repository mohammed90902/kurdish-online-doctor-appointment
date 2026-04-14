<section class="space-y-6">
    <header>
        <h2 class="text-xl font-bold text-red-600">
            سڕینەوەی هەژمار
        </h2>

        <p class="mt-2 text-sm text-gray-600">
            دوای سڕینەوەی هەژمارەکەت، هەموو داتاکانت بە یەکجاری دەسڕێنەوە. پێش سڕینەوە، دڵنیابە لە هەڵگرتنی هەر زانیارییەک کە پێویستتە.
        </p>
    </header>

    <button type="button" 
            x-data=""
            x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
            class="px-6 py-2 bg-red-600 text-white rounded-xl hover:bg-red-700 hover:shadow-lg transition-all duration-300 font-bold"
    >
        سڕینەوەی هەژمار
    </button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-xl font-bold text-gray-900 mb-4">
                دڵنیای لە سڕینەوەی هەژمارەکەت؟
            </h2>

            <p class="mt-1 text-sm text-gray-600 mb-6">
                دوای سڕینەوەی هەژمارەکەت، هەموو داتاکانت بە یەکجاری دەسڕێنەوە. تکایە وشەی نهێنیت بنووسە بۆ دڵنیابوونەوە.
            </p>

            <div class="mt-6">
                <x-input-label for="password" value="وشەی نهێنی" class="sr-only" />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-3/4 rounded-xl border-gray-200 focus:border-red-500 focus:ring-red-500 shadow-sm transition-all"
                    placeholder="وشەی نهێنی"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end gap-3">
                <button type="button" x-on:click="$dispatch('close')" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-xl hover:bg-gray-200 transition font-bold">
                    پاشگەزبوونەوە
                </button>

                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-xl hover:bg-red-700 transition font-bold">
                    سڕینەوەی هەژمار
                </button>
            </div>
        </form>
    </x-modal>
</section>
