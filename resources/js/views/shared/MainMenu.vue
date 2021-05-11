<template>
    <div class="menu-container">
        <nav class="main-menu">
            <h1>Infinite<strong>Conflict</strong></h1>
            <ul>
                <li><router-link :to="{ name: 'index' }"><span>Home</span></router-link></li>
                <li><router-link :to="{ name: 'planets.index' }"><span>Planets</span></router-link></li>
                <li><router-link :to="{ name: 'fleets.index' }"><span>Fleets</span></router-link></li>
                <li><router-link :to="{ name: 'nav.index' }"><span>Navigation</span></router-link></li>
                <li><router-link :to="{ name: 'research.index' }"><span>Research</span></router-link></li>
                <li><router-link :to="{ name: 'alliances.index' }"><span>Alliances</span></router-link></li>
                <li><router-link :to="{ name: 'auth.logout' }"><span>Logout</span></router-link></li>
            </ul>
        </nav>
        <div class="stripe"></div>
    </div>
</template>
