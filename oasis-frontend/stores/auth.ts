export const useAuthStore = defineStore('auth', ()=>{

    const user = ref<any | null>(null);
    const loading = ref(false);

    const isLoggedIn = computed(()=>!!user.value)

    async function fetchUser() {
        loading.value = true;
        try{
            const data = await $fetch('http://localhost:8000/api/user-data', {
                headers: {'Accept': 'application/json'},
                credentials: 'include'
            })
            user.value = data;
        }catch(error){
            user.value = null;
        }finally{
            loading.value = false;
        }
    }

    async function Logout() {
        try{
            await $fetch('http://localhost:8000/api/logout',{
                method: 'POST',
                credentials: 'include'
            });
        }finally{
            user.value = null;
            navigateTo('/')
        }
    }

    return {user, loading, isLoggedIn, fetchUser, Logout}
});