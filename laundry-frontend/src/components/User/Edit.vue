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
                                    <h6 class="m-0 font-weight-bold text-primary">Tambah Data User</h6>
                                </div>
                                <div class="card-body">
                                    <form @submit.prevent="edit">
                                        <div class="form-group">
                                            <label>Nama</label>
                                            <input type="text" class="form-control" v-model="users.nama">
                                        </div>
                                        <div class="form-group">
                                            <label>Username</label>
                                            <input type="text" class="form-control" v-model="users.username">
                                        </div>
                                        <!-- <div class="form-group">
                                            <label>Password</label>
                                            <input type="password" class="form-control" minlength="6" v-model="users.password">
                                        </div> -->
                                        <div class="form-group">
                                            <label>Role</label>
                                            <select class="form-select form-control" aria-label="Default Select Example" v-model="users.role" aria-placeholder="Pilih Role">
                                                <option value="owner">Owner</option>
                                                <option value="admin">Admin</option>
                                                <option value="kasir">Kasir</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Outlet</label>
                                            <select v-model="users.id_outlet" class="form-control">
                                                <option v-for="(o, index) in outlet" :key="index" :value="o.id_outlet">
                                                    {{ o.nama_outlet }}
                                                </option>
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-success btn-block">Simpan</button>
                                    </form>
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
            outlet: {},
            users: {},
        }
    },
    created() {
        var data = JSON.parse(this.$store.state.datauser)
        var role = data.role

        if (role == 'owner' || role == 'kasir') {
            this.$swal("Error", "Anda Tidak Dapat Mengakses Halaman Ini", "error")
            this.$router.push('/')
        }
        
        this.axios.get('http://localhost/latihan_laundry/public/api/outlet', {
            headers: { Authorization: 'Bearer ' + this.$store.state.token }
        }).then(res => {
            this.outlet = res.data.data
            console.log(res.data)
        }).catch(err => console.log(err))
        
        this.axios.get(`http://localhost/latihan_laundry/public/api/user/${this.$route.params.id}`, {
            headers: { Authorization: 'Bearer ' + this.$store.state.token }
        }).then(res => {
            this.users = res.data.data
        }).catch(err => console.log(err))
    },
    methods: {
        edit() {
            this.axios.put(`http://localhost/latihan_laundry/public/api/user/${this.$route.params.id}`, this.users, {
                headers: { Authorization: 'Bearer ' + this.$store.state.token }
            }).then(res => {
                if (res.data.success) {
                    this.$swal("Sukses", res.data.message, "success")
                    this.$router.push('/user')
                }
            }).catch(err => console.log(err))
        }
    }
}
</script>