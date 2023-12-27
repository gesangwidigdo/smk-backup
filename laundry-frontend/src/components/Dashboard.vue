<template>
    <div id="wrapper">
        <sidebar-component></sidebar-component>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <navbar-component></navbar-component>

                <div class="container-fluid">
                    <h1 class="h3 mb-4 text-gray-800">Selamat Datang, {{nama}}! Kamu login sebagai {{role}}</h1>
                </div>

            <div class="container justify-content-center">
                <div class="row">
                    <!-- Jumlah Member -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            Member
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ data.member }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Jumlah Pesanan Baru -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-success shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            Pesanan Baru
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ data.baru }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Jumlah Pesanan Diproses -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-warning shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            Pesanan Diproses
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ data.proses }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Pendapatan Bulan Ini -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-info shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            Pendapatan Bulan Ini
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">Rp{{ data.pendapatan_bulanan }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Total Pendapatan -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-danger shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            Total Pendapatan
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">Rp{{ data.pendapatan }}</div>
                                    </div>
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
            role: '',
            nama: '',
            data: ''
        }
    },
    created() {
        var user = JSON.parse(this.$store.state.datauser)
        this.role = user.role
        this.nama = user.nama

        this.axios.get('http://localhost/latihan_laundry/public/api/dashboard', {
            headers: { Authorization: 'Bearer ' + this.$store.state.token }
        }).then(res => {
            this.data = res.data
        })
    }
}
</script>