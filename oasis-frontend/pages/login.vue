<script setup lang="ts">

interface LoginForm {
    Email: string,
    Password: string
}

interface LoginResponse{
    message: string,
    user:{
        id:number,
        name:string,
        email:string
    }
}

const form = reactive<LoginForm>({
    Email: '',
    Password: ''
})

async function SubmitForm(args: LoginForm){

    await useFetch('http://localhost:8000/sanctum/csrf-cookie', {
        method: 'GET',
        credentials: 'include'
    });

    const xsrfToken = useCookie('XSRF-TOKEN').value;

    const {data, error} = await useFetch<LoginResponse>('http://localhost:8000/api/login', {
        method: 'POST',
        body: form,
        credentials: 'include',
        headers:{
            'Accept': 'applicationn/json',
            'Referer': 'http://localhost:3000',
            'X-XSRF-TOKEN': xsrfToken || '',
        }
    });

    if(error.value){
        console.log("Виникла помилка входу: ", error.value.data)
        alert(error.value.data.message || 'Помилка авторизації')
    } else{
        console.log("Успіх:", data.value?.message)
    }
}

</script>

<template>
    <div class="bg-[#ACBFA4] m-auto my-[10%] w-[30%] p-2">
        <h1 class="text-center font-bold text-[25px]">Логін</h1>
        <form class="flex flex-col gap-5" @submit.prevent="SubmitForm(form)">
            <label class="flex flex-col m-auto">
                <p>Email:</p>
                <input v-model="form.Email" class="border" type="text">
            </label>
            <label class="flex flex-col m-auto">
                <p>Password:</p>
                <input v-model="form.Password" class="border" type="password">
            </label>
            <button class="p-3 m-3 bg-green-400">Submit</button>
        </form>
    </div>
</template>