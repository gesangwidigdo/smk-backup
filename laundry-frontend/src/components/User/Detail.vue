<template>
    <div id="wrapper">
        <sidebar-component></sidebar-component>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <navbar-component></navbar-component>
                <div class="container-fluid">
                    <h1 class="h3 mb-4 text-gray-800">Detail User</h1>
                </div>
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-4 text-center">
                            <i class="far fa-user fa-7x text-gray-300"></i>
                        </div>
                        <div class="col py-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase">Nama</div>
                            <div class="h6 mb-0 font-weightt-bold text-gray-800 mb-2">{{ users.nama }}</div>
                            <div class="text-xs font-weight-bold text-primary text-uppercase">Username</div>
                            <div class="h6 mb-0 font-weightt-bold text-gray-800 mb-2">{{ users.username }}</div>
                            <div class="text-xs font-weight-bold text-primary text-uppercase">Passowrd</div>
                            <div class="h6 mb-0 font-weightt-bold text-gray-800 mb-2">( Rahasia )</div>
                            <div class="text-xs font-weight-bold text-primary text-uppercase">Role</div>
                            <div class="h6 mb-0 font-weightt-bold text-gray-800 mb-2" style="text-transform:capitalize;">{{ users.role }}</div>
                            <div class="text-xs font-weight-bold text-primary text-uppercase">Nama Outlet</div>
                            <div class="h6 mb-0 font-weightt-bold text-gray-800 mb-2">{{ users.nama_outlet }}</div>
                            <div class="text-xs font-weight-bold text-primary text-uppercase">Lokasi Outlet</div>
                            <div class="h6 mb-0 font-weightt-bold text-gray-800 mb-2">{{ users.alamat }}</div>
                        </div>
                    </div>
                </div>
            </div>
            <footer-component></footer-component>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            users: {}
        }
    },
    created() {
        var data = JSON.parse(this.$store.state.datauser)
        var role = data.role

        if (role == 'owner' || role == 'kasir') {
            this.$swal("Error", "Anda Tidak Dapat Mengakses Halaman Ini", "error")
            this.$router.push('/')
        }
        
        this.axios.get(`http://localhost/latihan_laundry/public/api/user/${this.$route.params.id}`, {
            headers: { Authorization: 'Bearer ' + this.$store.state.token }
        }).then(res => {
            this.users = res.data.data
        }).catch(err => console.log(err))
    }
}
</script>