<template>
    <div id="wrapper">
        <sidebar-component></sidebar-component>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <navbar-component></navbar-component>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Tambah Data Paket</h6>
                                </div>
                                <div class="card-body">
                                    <form @submit.prevent="tambah">
                                        <div class="form-group">
                                            <div>
                                                <label>Jenis Paket</label>
                                            </div>
                                            <select class="form-select form-control" aria-label="Default select example" v-model="paket.jenis">
                                                <option selected>Pilih Jenis Paket</option>
                                                <option value="kiloan">Kiloan</option>
                                                <option value="selimut">Selimut</option>
                                                <option value="bed_cover">Bed Cover</option>
                                                <option value="kaos">Kaos</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Harga</label>
                                            <input type="number" class="form-control" v-model="paket.harga">
                                        </div>
                                        <button type="submit" class="btn btn-success btn-block">Simpan</button>
                                    </form>
                                </div>
                            </div>
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
    },
    methods: {
        tambah() {
            this.axios.post('http://localhost/latihan_laundry/public/api/paket', this.paket, {
                headers: { Authorization: 'Bearer ' + this.$store.state.token }
            }).then((res) => {
                if (res.data.success) {
                    this.$swal("Sukses", res.data.message, "success")
                    this.$router.push('/paket')
                }
            }).catch(err => console.log(err))
        }
    }
}
</script>