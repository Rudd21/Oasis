<script setup lang="ts">

interface Project{
    name: string,
    
}

interface Bookmark{
    title: string;
    reqTo: string;
}

const bookmarkList: Record<string, Bookmark> = {
    task:{
        title: 'Task',
        reqTo: '/reqTasks'
    }, recTasks:{
        title: 'Recomended task',
        reqTo: '/recTasks'
    }, curTasks:{
        title: 'Current tasks',
        reqTo: '/curTasks'
    }, members:{
        title: 'Members',
        reqTo: '/reqMembers'
    }
}

const currentData = ref()
const isLoading = ref(false);

async function bookmarkRequest(endPoint: string) {
    isLoading.value = true
    try{
        const response = await $fetch(`http://localhost:8000/api${endPoint}`,{
            credentials: 'include'
        });

        currentData.value = response;
    }catch(error){
        console.error('Помилка запиту', error)
    }finally{
        isLoading.value = false;
    }
}

</script>

<template>
    <div class="m-5 flex flex-col h-screen overflow-hidden  rounded-xl">
        <!-- Work place -->
        <div class="flex min-h-[10%] bg-red-500">
            <NuxtLink class="flex p-1 items-center m-2 hover:text-blue-600 transition" href="/createProject">Create Project</NuxtLink>
        </div>

        <!-- Bookmarks -->
        <div class="flex flex-grow">

            <!-- Project bar -->
            <div class="min-w-[20%] bg-blue-500">
                <ul class="flex flex-col gap-5 m-5">
                    <li
                        v-for="(item, key) in bookmarkList"
                        :key="key"
                        @click="bookmarkRequest(item.reqTo)"
                        class="cursor-pointer text-center bg-white p-2 rounded-[10px] hover:text-blue-400 transition-color"
                    >{{ item.title }}</li>
                </ul>
            </div>

            <!-- Work place -->
            <div class="flex-grow bg-green-500">
                <h1>Main</h1>
                <p>{{ currentData }}</p>
            </div>
        </div>
    </div>

</template>