<script setup lang="ts">

const route = useRoute();
const projectId = route.params.id;

// Request projects
const projectList = ref();
const currentProject = ref();

interface ProjectShort{
    id: number | string,
    title: string,
}

interface FoundProjects{
    message: string,
    data: ProjectShort[],
}

async function reqProjects() {
    try{
        const projects = await $fetch<FoundProjects>('http://localhost:8000/api/reqProjects',{
            'method': 'GET',
            'credentials': 'include'
        })

        projectList.value = projects.data;
    }catch(error){
        console.error('Виникла помилка:', error);
    }finally{

    }
}

onMounted(()=>{
    reqProjects();
})

// Bookmark requests
interface Bookmark{
    title: string;
    to: string;
    reqTo: string;
}

const bookmarkList: Record<string, Bookmark> = {
    tasks:{
        title: 'Tasks',
        to: '/task',
        reqTo: '/reqTasks'
    }, recTasks:{
        title: 'Recomended task',
        to: '/recTask',
        reqTo: '/recTasks'
    }, curTasks:{
        title: 'Current tasks',
        to: '/tassk',
        reqTo: '/curTasks'
    }, members:{
        title: 'Members',
        to: '/members',
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
    <div class="m-5 flex flex-col h-screen overflow-hidden border-2 border-[#D96868] rounded-xl">
        <!-- Work place -->
        <div class="flex min-h-[10%] items-center">
            <button 
                v-for="project in projectList" 
                :key="project.id"
                @click="currentProject = project.id"
                :class="[currentProject === project.id ? 'underline' : 'hover:bg-[#D96868] hover:text-white']" 
                class="bg-white h-[60%] m-2 text-black px-4 py-2 rounded-lg transition-colors shadow-sm"
            >
                {{ project.title }}
            </button>
            |
            <NuxtLink class="flex p-1 items-center m-2 text-[#D96868] hover:text-white hover:bg-[#D96868] rounded-[5px] transition" href="/createProject">+ Create Project</NuxtLink>
        </div>

        <!-- Bookmarks -->
        <div class="flex flex-grow">

            <!-- Project bar -->
            <div class="min-w-[20%] bg-[#D96868]">
                <div class="flex flex-col gap-5 m-5">
                    <NuxtLink
                        v-for="(item, key) in bookmarkList"    
                        :key="key"
                        :to="`/project/${projectId}${item.to}`"
                        :disabled="!currentProject"
                        :class="[currentProject === '' ? '' : 'hover:text-[#D96868]']" 
                        class="cursor-pointer text-center bg-white p-2 rounded-[10px] transition-color disabled:text-gray-400 disabled:bg-gray-200 transistion"
                    >
                        {{ item.title }}
                </NuxtLink>
                </div>
            </div>

            <!-- Work place -->
            <div class="flex-grow border-t-2 border-[#D96868] bg-[#FBF6F6]">
                <NuxtPage />
            </div>
        </div>
    </div>

</template>