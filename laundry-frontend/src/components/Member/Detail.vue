<template>
    <div id="wrapper">
        <sidebar-component></sidebar-component>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <navbar-component></navbar-component>
                <div class="container-fluid">
                    <h1 class="h3 mb-4 text-gray-800">Detail Member</h1>
                </div>
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-4 text-center">
                            <i class="far fa-user fa-7x text-gray-300"></i>
                        </div>
                        <div class="col py-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase">Nama</div>
                            <div class="h6 mb-0 font-weightt-bold text-gray-800 mb-2">{{ member.nama_member }}</div>
                            <div class="text-xs font-weight-bold text-primary text-uppercase">Jenis Kelamin</div>
                            <div class="h6 mb-0 font-weightt-bold text-gray-800 mb-2">{{ member.jenis_kelamin }}</div>
                            <div class="text-xs font-weight-bold text-primary text-uppercase">alamat</div>
                            <div class="h6 mb-0 font-weightt-bold text-gray-800 mb-2">{{ member.alamat }}</div>
                            <div class="text-xs font-weight-bold text-primary text-uppercase">No. Telepon</div>
                            <div class="h6 mb-0 font-weightt-bold text-gray-800 mb-2">{{ member.no_tlp }}</div>
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
            member: {}
        }
    },
    created() {
        var data = JSON.parse(this.$store.state.datauser)
        var role = data.role

        if (role == 'owner') {
            this.$swal("Error", "Anda Tidak Dapat Mengakses Halaman Ini", "error")
            this.$router.push('/')
        }
        
        this.axios.get(`http://localhost/latihan_laundry/public/api/member/show/${this.$route.params.id_member}`, {
            headers: { Authorization: 'Bearer ' + this.$store.state.token }
        }).then((res) => {
            this.member = res.data.data
        }).catch(err => console.log(err))
    }
}
</script>