<template>
    <ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">
        <!-- Sidebar Brand -->
        <a href="index.html" class="sidebar-brand d-flex align-items-center justify-content-center">
            <div class="sidebar-brand-text mx-3">Laundry Online</div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item Dashboard -->
        <li class="nav-item">
            <router-link to="/" class="nav-link" href="index.html">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </router-link>
        </li>

        <li v-if="isAdmin" class="nav-item">
            <router-link to="/user" class="nav-link" href="index.html">
                <i class="fas fa-user"></i>
                <span>User</span>
            </router-link>
        </li>

        <li v-if="isAdmin || isKasir" class="nav-item">
            <router-link to="/member" class="nav-link" href="index.html">
                <i class="fas fa-users"></i>
                <span>Member</span>
            </router-link>
        </li>
        
        <li v-if="isAdmin" class="nav-item">
            <router-link to="/outlet" class="nav-link" href="index.html">
                <i class="fas fa-store"></i>
                <span>Outlet</span>
            </router-link>
        </li>

        <li v-if="isAdmin" class="nav-item">
            <router-link to="/paket" class="nav-link" href="index.html">
                <i class="fas fa-tshirt"></i>
                <span>Paket Laundry</span>
            </router-link>
        </li>

        <li v-if="isAdmin || isKasir" class="nav-item">
            <router-link to="/transaksi" class="nav-link" href="index.html">
                <i class="fas fa-file-invoice-dollar"></i>
                <span>Transaksi</span>
            </router-link>
        </li>

        <li class="nav-item">
            <router-link to="/report" class="nav-link">
                <i class="far fa-file-alt"></i>
                <span>Report</span>
            </router-link>
        </li>
    </ul>
</template>

<script>
export default {
    data() {
        return {
            isAdmin: false,
            isKasir: false,
            isOwner: false
        }
    },
    created() {
        var user = JSON.parse(this.$store.state.datauser)
        var role = user.role

        if (role == 'admin') {
            this.isAdmin = true
        } else if (role == 'kasir') {
            this.isKasir = true
        } else {
            this.isOwner = true
        }
    }
}
</script>