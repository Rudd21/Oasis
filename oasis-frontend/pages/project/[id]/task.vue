<script setup lang="ts">

const route = useRoute();
const projectId = route.params.id;

interface TaskSprint{
    Title: string;
    StartDate: Date;
    EndDate: Date;
}

type Task = {
    Title: string;
    Description: string,
    Priority: string,
    IdSprint: TaskSprint;
    TaskTakedBy: number | string,
    TaskTakedAt: Date,
}

async function reqSprint() {

    
}

</script>

<template>
    <h1>Задачі проєкту {{ projectId }}</h1>
</template>