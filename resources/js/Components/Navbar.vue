<template>
    <div class="nav">
        <div class="notification text-center py-3 bg-red-600 px-4 text-sm font-medium text-primary-foreground sm:px-6 lg:px-8" v-if="$page.props.globals.nav.banner" v-html="$page.props.globals.nav.banner"></div>
        <Disclosure as="nav" :class="bg" v-slot="{ open }">
            <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
                <div class="relative flex h-16 items-center justify-between">
                    <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
                        <!-- Mobile menu button-->
                        <DisclosureButton class="relative inline-flex items-center justify-center rounded-md p-2 text-primary-foreground hover:bg-gray-100 hover:text-black focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white">
                            <span class="absolute -inset-0.5" />
                            <span class="sr-only">Open main menu</span>
                            <Bars3Icon v-if="!open" class="block h-6 w-6" aria-hidden="true" />
                            <XMarkIcon v-else class="block h-6 w-6" aria-hidden="true" />
                        </DisclosureButton>
                    </div>
                    <div class="flex flex-1 items-center justify-center sm:items-stretch sm:justify-start">
                        <div class="flex flex-shrink-0 items-center">
                            <enhanced-link :href="`/${$page.props.locale}`">
                                <img class="h-8 relative w-auto" src="/logo.svg" :alt="$page.props.globals.general.copyright" style="top: 1px;" />
                            </enhanced-link>
                        </div>
                        <div class="hidden sm:ml-6 sm:block">
                            <div class="flex space-x-4">
                                <enhanced-link v-for="item in $page.props.globals.nav.navlinks" :key="item.name" :href="item.link" :class="[isActive(item) ? 'bg-gray-100 text-black' : 'text-primary-foreground hover:bg-white/15', 'rounded-md px-3 py-2 font-medium']" :aria-current="isActive(item) ? 'page' : undefined">{{ item.name }}</enhanced-link>
                            </div>
                        </div>
                        <div class="hidden lg:flex lg:flex-1 lg:justify-end">
                            <Menu as="div" class="relative ml-3">
                                <div>
                                    <MenuButton class="mr-3 inline-block rounded-md px-3.5 py-2.5 text-sm font-semibold text-primary-foreground focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-${variant}-600">
                                        <span class="absolute -inset-1.5" />
                                        <span class="sr-only">Open language menu</span>
                                        <LanguageIcon class="w-5 h-5" />
                                    </MenuButton>
                                </div>
                                <transition enter-active-class="transition ease-out duration-100" enter-from-class="transform opacity-0 scale-95" enter-to-class="transform opacity-100 scale-100" leave-active-class="transition ease-in duration-75" leave-from-class="transform opacity-100 scale-100" leave-to-class="transform opacity-0 scale-95">
                                    <MenuItems class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
                                        <MenuItem v-for="(locale, key) in $page.props.availableLocales">
                                            <enhanced-link :href="`/${key}`" class="block px-4 py-2 text-sm text-gray-700">{{ locale.native }}</enhanced-link>
                                        </MenuItem>
                                    </MenuItems>
                                </transition>
                            </Menu>
                            <UButton :href="$page.props.globals.nav.nav_cta_link" variant="red" :title="$page.props.globals.nav.nav_cta_text" v-if="$page.props.globals.nav.nav_cta_text" />
                        </div>
                    </div>
                </div>
            </div>

            <DisclosurePanel class="sm:hidden">
                <div class="space-y-1 px-2 pb-3 pt-2">
                    <enhanced-link v-for="item in $page.props.globals.nav.navlinks" :key="item.name" as="a" :href="item.link" :class="[isActive(item) ? 'bg-gray-100 text-black' : 'text-primary-foreground hover:bg-gray-100 hover:text-black', 'block rounded-md px-3 py-2 text-base font-medium']" :aria-current="isActive(item) ? 'page' : undefined">{{ item.name }}</enhanced-link>
                </div>
            </DisclosurePanel>
        </Disclosure>
        <div class="line"></div>
    </div>
</template>

<style scoped>
.nav .line {
    background-color: hsla(0,0%,100%,.1);
    height: 1px;
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
}
.nav {
    left: 0;
    position: sticky;
    right: 0;
    top: 0;
    z-index: 999;
}
</style>

<script setup>
import {Disclosure, DisclosureButton, DisclosurePanel, Menu, MenuButton, MenuItem, MenuItems} from '@headlessui/vue'
import {Bars3Icon, XMarkIcon, LanguageIcon} from '@heroicons/vue/24/outline'
import {usePage} from "@inertiajs/vue3";
import {computed} from "vue";
import EnhancedLink from "@/Components/EnhancedLink.vue";
import UButton from "@/Components/UButton.vue";

const route = usePage().props.ziggy.location;

const bg = computed(() => {
    return 'bg-primary';
});

const isActive = (item) => {
    return route.indexOf(item.link) !== -1;
}

</script>
