<script setup lang="ts">

interface RegisterForm {
    Email: string;
    Name: string;
    Password: string;
    PasswordConfirmation: string;
}

const form = reactive<RegisterForm>({
    Email: '',
    Name: '',
    Password: '',
    PasswordConfirmation: ''
});

async function submitForm(args: RegisterForm){
    if(args.Password != args.PasswordConfirmation){
        console.log("Паролі не співпадають")
        return;
    }
    
    type RegisterRequest = Omit<RegisterForm, 'PasswordConfirmation'>

    const payload: RegisterRequest = {
        Email: args.Email,
        Name: args.Name,
        Password: args.Password
    }

    const {data, error} =await useFetch('http://localhost:8000/api/register', {
        method: 'POST',
        body: payload
    })
}

</script>

<template>
    <div class="m-auto bg-[#ACBFA4] m-auto">
        <h1>Форма реєстрації</h1>
        <form class="flex flex-col gap-5" @submit.prevent="submitForm(form)">
            <label>
                Email:
                <input v-model="form.Email" name="Email" class="border" type="email" required>
            </label>
            <label>
                Name:
                <input v-model="form.Name" class="border" type="text" required>
            </label>
            <label>
                Password:
                <input v-model="form.Password" class="border" type="password" required>
            </label>
            <label>
                Repeat password:
                <input v-model="form.PasswordConfirmation" class="border" type="password">
            </label>
            <button class="p-3 bg-green-400 disable:">Submit</button>
        </form>
    </div>
</template>