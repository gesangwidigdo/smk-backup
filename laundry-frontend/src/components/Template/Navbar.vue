<template>
    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item mt-1"><strong>{{ nama_outlet }}</strong></li>
            <div class="topbar-divider d-none d-sm-block"></div>
            <li class="nav-item">
                <button class="btn btn-sm btn-warning btn-icon-split" @click="logout">
                    <span class="icon text-white-50">
                        <i class="fas fa-sign-out-alt"></i>
                    </span>
                    <span class="text">Logout</span>
                </button>
            </li>
        </ul>
    </nav>
</template>

<script>
export default {
    data() {
        return {
            nama_outlet: ''
        }
    },
    created(){
        var data = JSON.parse(this.$store.state.dataoutlet)
        var namaoutlet = data.nama_outlet
        console.log(namaoutlet)

        this.nama_outlet = namaoutlet
        
        this.axios.get('http://localhost/latihan_laundry/public/api/login/check', {
            headers: { Authorization: 'Bearer ' + this.$store.state.token }
        }).then(res => {
            if (!(res.data.success)) {
                this.$store.commit('clearToken')
                this.$store.commit('clearUser')
                this.$swal("Error", "Sesi anda Sudah Habis", "error")
                this.$router.push('/login')
            }
        })
    },
    methods: {
        logout() {
            this.axios.post('http://localhost/latihan_laundry/public/api/logout', { headers: {'Authorization': 'Bearer' + this.$store.state.token} })
                        .then( () => {
                            this.$store.commit('clearToken')
                            this.$store.commit('clearUser')
                            this.$router.push('/login')
                        })
        }
    }
}
</script>