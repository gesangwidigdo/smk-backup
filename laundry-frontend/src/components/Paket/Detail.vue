<template>
    <div id="wrapper">
        <sidebar-component></sidebar-component>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <navbar-component></navbar-component>
                <div class="container-fluid">
                    <h1 class="h3 mb-4 text-gray-800">Detail Paket</h1>
                </div>
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-4 text-center">
                            <i class="fas fa-box-open fa-7x text-gray-300"></i>
                        </div>
                        <div class="col py-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase">Jenis</div>
                            <div class="h6 mb-0 font-weightt-bold text-gray-800 mb-2">{{ paket.jenis }}</div>
                            <div class="text-xs font-weight-bold text-primary text-uppercase">Harga</div>
                            <div class="h6 mb-0 font-weightt-bold text-gray-800 mb-2">{{ paket.harga }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            paket: {}
        }
    },
    created() {
        var data = JSON.parse(this.$store.state.datauser)
        var role = data.role

        if (role == 'owner' || role == 'kasir') {
            this.$swal("Error", "Anda Tidak Dapat Mengakses Halaman Ini", "error")
            this.$router.push('/')
        }
        
        this.axios.get(`http://localhost/latihan_laundry/public/api/paket/${this.$route.params.id_paket}`, {
            headers: { Authorization: 'Bearer ' + this.$store.state.token }
        }).then((res) => {
            this.paket = res.data.data
        }).catch(err => console.log(err))
    }
}
</script>