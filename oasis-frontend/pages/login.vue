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
    <div class="m-auto bg-[#ACBFA4] m-auto">
        <h1>Логін</h1>
        <form class="flex flex-col gap-5" @submit.prevent="SubmitForm(form)">
            <label>
                Email:
                <input v-model="form.Email" class="border" type="text">
            </label>
            <label>
                Password:
                <input v-model="form.Password" class="border" type="password">
            </label>
            <button class="p-3 bg-green-400">Submit</button>
        </form>
    </div>
</template>