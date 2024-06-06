<!-- Componente que se encarga de la cabecera -->
<script setup>
import { Menu, MenuButton, MenuItem, MenuItems } from '@headlessui/vue';
import { getRutePinia } from '~/stores/getRutePinia';
import { computed } from 'vue';

const getRoute = getRutePinia();

const navStyle = "transition duration-300 ease-in-out transform hover:scale-105 hover:text-yellow-400";

// Crea una función que genera una propiedad computada para un url específico.
function createIsActiveForUrl(urlCompar, patron) {
    return computed(() => {
        return getRoute.url === `/${urlCompar}` ||
            new RegExp(`^/${urlCompar}/${patron}$`).test(getRoute.url);
    });
}

const idPatron = '[0-9a-zA-Z]{8}-[0-9a-zA-Z]{4}-[0-9a-zA-Z]{4}-[0-9a-zA-Z]{4}-[0-9a-zA-Z]{12}';

const isActiveStudent = createIsActiveForUrl('student', idPatron);
const isActiveStaff = createIsActiveForUrl('staff', idPatron);
const isActiveHouse = createIsActiveForUrl('house', idPatron);

const isActiveAdmin = createIsActiveForUrl('admin', '[a-zA-Z]*');

</script>

<template>
    <header class="bg-blue-900 text-white py-4">
        <div class="container mx-auto flex justify-between items-center">
            <NuxtLink class='text-2xl font-bold' to="/">
                Harry Potter Web App
            </NuxtLink>
            <nav>
                <ul class="flex space-x-4">
                    <NuxtLink :class="[navStyle, isActiveStudent ? 'text-yellow-400 ' : '']" to="/student">
                        Estudiantes
                    </NuxtLink>
                    <NuxtLink :class="[navStyle, isActiveStaff ? 'text-yellow-400 ' : '']" to="/staff">
                        Profesores
                    </NuxtLink>
                    <NuxtLink :class="[navStyle, isActiveHouse ? 'text-yellow-400 ' : '']" to="/house">
                        Casas
                    </NuxtLink>
                    <Menu as="div" class="relative inline-block text-left">
                        <div>
                            <MenuButton :class="[
                                navStyle,
                                isActiveAdmin ? 'text-yellow-400 ' : ''
                            ]">
                                Administración
                            </MenuButton>
                        </div>

                        <transition enter-active-class="transition ease-out duration-100"
                            enter-from-class="transform opacity-0 scale-95"
                            enter-to-class="transform opacity-100 scale-100"
                            leave-active-class="transition ease-in duration-75"
                            leave-from-class="transform opacity-100 scale-100"
                            leave-to-class="transform opacity-0 scale-95">
                            <MenuItems
                                class="absolute right-0 z-10 mt-2 w-56 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-blue-500 ring-opacity-5 focus:outline-none">
                                <div class="py-1">
                                    <MenuItem v-slot="{ active }">
                                    <NuxtLink to="/admin/student" :class="[
                                        'block px-4 py-2 text-sm',
                                        active ? 'bg-blue-500 text-white' : 'text-blue-700 hover:bg-blue-100',
                                        getRoute.url === '/admin/student' ? 'font-bold text-blue-800' : ''
                                    ]">
                                        Estudiantes
                                    </NuxtLink>
                                    </MenuItem>
                                    <MenuItem v-slot="{ active }">
                                    <NuxtLink to="/admin/staff" :class="[
                                        'block px-4 py-2 text-sm',
                                        active ? 'bg-blue-500 text-white' : 'text-blue-700 hover:bg-blue-100',
                                        getRoute.url === '/admin/staff' ? 'font-bold text-blue-800' : ''
                                    ]">
                                        Profesores
                                    </NuxtLink>
                                    </MenuItem>
                                    <MenuItem v-slot="{ active }">
                                    <NuxtLink to="/admin/houses" :class="[
                                        'block px-4 py-2 text-sm',
                                        active ? 'bg-blue-500 text-white' : 'text-blue-700 hover:bg-blue-100',
                                        getRoute.url === '/admin/houses' ? 'font-bold text-blue-800' : ''
                                    ]">
                                        Casas
                                    </NuxtLink>
                                    </MenuItem>
                                </div>
                            </MenuItems>
                        </transition>
                    </Menu>
                </ul>
            </nav>
        </div>
    </header>
</template>
