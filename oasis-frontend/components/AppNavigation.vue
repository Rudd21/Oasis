<script setup lang="ts">

interface NavigationList {
    nav1: string;
    nav2: string;
    nav3: string;
    nav4: string;
}

const navigationMap: Record<string, NavigationList>={
    project:{
        nav1: 'nav1',
        nav2: 'nav1',
        nav3: 'nav1',
        nav4: 'nav1',
    },
    manager:{
        nav1: 'nav2',
        nav2: 'nav2',
        nav3: 'nav2',
        nav4: 'nav2',
    },
    worker:{
        nav1: 'nav3',
        nav2: 'nav3',
        nav3: 'nav3',
        nav4: 'nav3',
    },
    dashboard:{
        nav1: 'nav4',
        nav2: 'nav4',
        nav3: 'nav4',
        nav4: 'nav4',
    },
}

const activeNav =  ref('project');

const currentNav = computed(()=> navigationMap[activeNav.value])

</script>

<template>
    <nav 
        class="group bg-[#E2E8CE] font-[Open Sans] p-3"
        @mouseleave="activeNav = 'none'"    
    >
        <ul class="flex justify-around items-center">
            <li class="flex items-center gap-5">
                <img class="w-10 h-10" src="/logo.png" alt="">
                <h1 class="text-[#FF7F11] font-bold">Oasis</h1>
                <div>
                    <button 
                        v-for="(content, key) in navigationMap"
                        :key="key"
                        @mouseenter="activeNav = key"
                        :class="['group p-3 rounded-[5px] transition', activeNav === 'project' ? 'text-[#FF7F11]' : 'hover:text-[#FF7F11]']" 
                    >{{ key }} ⇓</button>
                </div>
            </li>
            <li>
                <div class="flex gap-2 bg-white border p-2 rounded-[15px]">
                    <p class="text-gray-400">Search:</p> 
                    <input class="border-b-2 border-black focus:border-gray-400 transition focus:outline-none" type="text" name="" id="">
                </div>
            </li>
            <li class="flex gap-3">
                <a href="/login">Login</a>
                <a href="/register">Register</a>
            </li>
        </ul>
        <Transition
            mode="out-in"
            enter-active-class="transition duration-500 ease-out"
            enter-from-class="transform -translate-y-4 opacity-0"
            enter-to-class="transform translate-y-0 opacity-100"
            leave-active-class="transition duration-300 ease-in"
            leave-from-class="transform translate-y-0 opacity-100"
            leave-to-class="transform translate-y-2 opacity-0"
            :class="[activeNav === 'none' ? 'hidden' : 'visible']"
        >
            <div class="flex translate-y-[0px] group-hover:opacity-100 transition-opacity">
                <ul :key="currentNav?.nav1" class="flex mx-[100px]">
                    <li><a class="p-3 border rounded-[15px]" href="">{{currentNav?.nav1}}</a></li>
                    <li><a class="p-3 border rounded-[15px]" href="">{{ currentNav?.nav2 }}</a></li>
                    <li><a class="p-3 border rounded-[15px]" href="">{{currentNav?.nav3}}</a></li>
                    <li><a class="p-3 border rounded-[15px]" href="">{{ currentNav?.nav4 }}</a></li>
                </ul>
            </div>
        </Transition>
    </nav>
</template>