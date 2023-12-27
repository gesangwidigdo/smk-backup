<template>
    <div id="wrapper">
        <sidebar-component></sidebar-component>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <navbar-component></navbar-component>
                <div class="container-fluid">
                    <h1 class="h3 mb-4 text-gray-800">Data Transaksi</h1>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card shadow mb-4">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <router-link to="/transaksi/tambah" class="btn btn-info btn-icon-split">
                                            <span class="icon text-white-50">
                                                <i class="fas fa-plus"></i>
                                            </span>
                                            <span class="text">Tambah</span>
                                        </router-link>
                                        <table class="table table bordered mt-3" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Nama Member</th>
                                                    <th>Tanggal Order</th>
                                                    <th>Batas Waktu</th>
                                                    <th>Status</th>
                                                    <th>Petugas</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="(t, index) in transaksi" :key="index">
                                                    <td>{{ index + 1 }}</td>
                                                    <td>{{ t.nama_member }}</td>
                                                    <td>{{ t.tgl | moment("DD/MM/YYYY") }}</td>
                                                    <td>{{ t.batas_waktu | moment("DD/MM/YYYY") }}</td>
                                                    <td>
                                                        <span v-if="t.status == 'baru'" class="badge bg-info text-light">Baru</span>
                                                        <span v-if="t.status == 'proses'" class="badge bg-warning text-dark">Proses</span>
                                                        <span v-if="t.status == 'selesai'" class="badge bg-success text-light">Selesai</span>
                                                        <span v-if="t.status == 'diambil'" class="badge bg-secondary text-light">Diambil</span>
                                                    </td>
                                                    <td>{{ t.nama }}</td>
                                                    <td>
                                                        <router-link class="btn btn-success btn-circle mr-1" :to="{ name: 'detail_transaksi', params: { id_transaksi: t.id_transaksi } }">
                                                            <i class="far fa-eye"></i>
                                                        </router-link>
                                                        <span v-if="t.status == 'baru'">
                                                            <router-link class="btn btn-warning btn-circle mr-1" :to="{ name: 'edittransaksi', params: { id_transaksi: t.id_transaksi } }">
                                                                <i class="fas fa-pen"></i>
                                                            </router-link>
                                                        </span>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
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
            transaksi: {}
        }
    },
    created() {
        var data = JSON.parse(this.$store.state.datauser)
        var role = data.role

        if (role == 'owner') {
            this.$swal("Error", "Anda Tidak Dapat Mengakses Halaman Ini", "error")
            this.$router.push('/')
        }

        this.axios.get('http://localhost/latihan_laundry/public/api/transaksi/tampil', {
            headers: { Authorization: 'Bearer ' + this.$store.state.token }
        }).then(res => {
            this.transaksi = res.data.data
            console.log(res.data.data)
        }).catch(err => console.log(err))
    },
    // computed: {
    //     disableEdit() {
    //         if (this.transaksi.status =='proses' || this.transaksi.status == 'selesai' || this.transaksi.status == 'diambil') {
    //             return true
    //         } else {
    //             return false
    //         }
    //     }
    // },
    methods: {
        // 
    }
}
</script>