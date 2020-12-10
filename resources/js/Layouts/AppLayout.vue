<template>
<v-app>
    <div class="min-h-screen" style="background-color: #F6F7FF; overflow-y: hidden;">

        <v-navigation-drawer v-model="drawer" app floating :permanent="drawer" :mini-variant.sync="mini">
            <v-card class="mx-auto" max-width="300" tile>
                <v-list rounded dense>
                    <v-list-item-group color="primary">
                        <v-list-item>
                            <v-list-item-icon>
                                <v-icon>mdi-account-circle-outline</v-icon>
                            </v-list-item-icon>
                            <v-list-item-content>
                                <v-list-item-title>{{ $page.user.name }}</v-list-item-title>
                            </v-list-item-content>
                        </v-list-item>
                    </v-list-item-group>
                </v-list>
            </v-card>

            <v-list dense rounded>
                <v-list-group v-for="item in items" :key="item.text" v-model="item.active" :prepend-icon="item.icon" no-action>
                    <template v-slot:activator>
                        <v-list-item-content>
                            <v-list-item-title v-text="item.text"></v-list-item-title>
                        </v-list-item-content>
                    </template>

                    <v-list-item v-for="child in item.children" :key="child.text" class="pl-4">
                        <v-list-item-icon>
                            <v-icon>{{child.icon_2}}</v-icon>
                        </v-list-item-icon>
                        <v-list-item-content>
                            <v-list-item-title v-text="child.text"></v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>
                </v-list-group>
            </v-list>
        </v-navigation-drawer>

        <v-app-bar app gray elevation="2">
            <v-app-bar-nav-icon @click.stop="drawer = !drawer"></v-app-bar-nav-icon>
            <v-spacer></v-spacer>

            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <div class="ml-3 relative">
                    <jet-dropdown align="right" width="48">
                        <template #trigger>
                            <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                                <div>
                                    <v-icon>mdi-account</v-icon>
                                </div>
                            </button>
                        </template>

                        <template #content>
                            <!-- Account Management -->
                            <div class="block px-4 py-2 text-xs text-gray-400">
                                Manage Account
                            </div>

                            <jet-dropdown-link :href="route('profile.show')">
                                Profile
                            </jet-dropdown-link>

                            <jet-dropdown-link :href="route('api-tokens.index')" v-if="$page.jetstream.hasApiFeatures">
                                API Tokens
                            </jet-dropdown-link>

                            <div class="border-t border-gray-100"></div>

                            <!-- Team Management -->
                            <template v-if="$page.jetstream.hasTeamFeatures">
                                <div class="block px-4 py-2 text-xs text-gray-400">
                                    Manage Team
                                </div>

                                <!-- Team Settings -->
                                <jet-dropdown-link :href="route('teams.show', $page.user.current_team)">
                                    Team Settings
                                </jet-dropdown-link>

                                <jet-dropdown-link :href="route('teams.create')" v-if="$page.jetstream.canCreateTeams">
                                    Create New Team
                                </jet-dropdown-link>

                                <div class="border-t border-gray-100"></div>

                                <!-- Team Switcher -->
                                <div class="block px-4 py-2 text-xs text-gray-400">
                                    Switch Teams
                                </div>

                                <template v-for="team in $page.user.all_teams">
                                    <form @submit.prevent="switchToTeam(team)" :key="team.id">
                                        <jet-dropdown-link as="button">
                                            <div class="flex items-center">
                                                <svg v-if="team.id == $page.user.current_team_id" class="mr-2 h-5 w-5 text-green-400" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                                <div>{{ team.name }}</div>
                                            </div>
                                        </jet-dropdown-link>
                                    </form>
                                </template>

                                <div class="border-t border-gray-100"></div>
                            </template>

                            <!-- Authentication -->
                            <form @submit.prevent="logout">
                                <jet-dropdown-link as="button">
                                    Logout
                                </jet-dropdown-link>
                            </form>
                        </template>
                    </jet-dropdown>
                </div>
            </div>
        </v-app-bar>

        <!-- Page Heading
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <slot name="header"></slot>
            </div>
        </header>-->

        <!-- Page Content -->

        <v-main>
            <v-container fluid>
                <!-- If using vue-router -->
                <router-view>
                    <slot></slot>
                </router-view>
            </v-container>
        </v-main>

        <!--<v-footer app>

        </v-footer>-->

        <!-- Modal Portal -->
        <portal-target name="modal" multiple>
        </portal-target>
    </div>
</v-app>
</template>

<script>
import JetApplicationMark from '@/Jetstream/ApplicationMark'
import JetDropdown from '@/Jetstream/Dropdown'
import JetDropdownLink from '@/Jetstream/DropdownLink'
import JetNavLink from '@/Jetstream/NavLink'
import JetResponsiveNavLink from '@/Jetstream/ResponsiveNavLink'

export default {
    components: {
        JetApplicationMark,
        JetDropdown,
        JetDropdownLink,
        JetNavLink,
        JetResponsiveNavLink,
    },

    data() {
        return {
            drawer: null,
            items: [{
                    icon: 'mdi-account-circle-outline',
                    text: 'Accueil'
                },
                {
                    icon: 'mdi-history',
                    text: 'Qualité'
                },
                {
                    icon: 'mdi-alert-circle',
                    text: 'Société'
                },
                {
                    icon: 'mdi-alert-circle',
                    text: 'Produits',
                    model: false,
                    children: [{
                            icon_2: 'mdi-circle-medium',
                            text: 'Ajout'
                        },
                        {
                            icon_2: 'mdi-circle-medium',
                            text: 'Modification'
                        },
                        {
                            icon_2: 'mdi-circle-medium',
                            text: 'Print'
                        },
                        {
                            icon_2: 'mdi-circle-medium',
                            text: 'Undo changes'
                        },
                        {
                            icon_2: 'mdi-circle-medium',
                            text: 'Test'
                        },
                    ],
                },
                {
                    icon: 'mdi-alert-circle',
                    text: 'Test'
                }, {
                    icon: 'mdi-account-circle-outline',
                    text: 'Accueil'
                },
                {
                    icon: 'mdi-history',
                    text: 'Qualité'
                },
                {
                    icon: 'mdi-alert-circle',
                    text: 'Société'
                },
                {
                    icon: 'mdi-alert-circle',
                    text: 'Produits',
                    model: false,
                    children: [{
                            icon_2: 'mdi-circle-medium',
                            text: 'Ajout'
                        },
                        {
                            icon_2: 'mdi-circle-medium',
                            text: 'Modification'
                        },
                        {
                            icon_2: 'mdi-circle-medium',
                            text: 'Print'
                        },
                        {
                            icon_2: 'mdi-circle-medium',
                            text: 'Undo changes'
                        },
                        {
                            icon_2: 'mdi-circle-medium',
                            text: 'Test'
                        },
                    ],
                },
                {
                    icon: 'mdi-alert-circle',
                    text: 'Test'
                }, {
                    icon: 'mdi-account-circle-outline',
                    text: 'Accueil'
                },
                {
                    icon: 'mdi-history',
                    text: 'Qualité'
                },
                {
                    icon: 'mdi-alert-circle',
                    text: 'Société'
                },
                {
                    icon: 'mdi-alert-circle',
                    text: 'Produits',
                    model: false,
                    children: [{
                            icon_2: 'mdi-circle-medium',
                            text: 'Ajout'
                        },
                        {
                            icon_2: 'mdi-circle-medium',
                            text: 'Modification'
                        },
                        {
                            icon_2: 'mdi-circle-medium',
                            text: 'Print'
                        },
                        {
                            icon_2: 'mdi-circle-medium',
                            text: 'Undo changes'
                        },
                        {
                            icon_2: 'mdi-circle-medium',
                            text: 'Test'
                        },
                    ],
                },
                {
                    icon: 'mdi-alert-circle',
                    text: 'Test'
                }, {
                    icon: 'mdi-account-circle-outline',
                    text: 'Accueil'
                },
                {
                    icon: 'mdi-history',
                    text: 'Qualité'
                },
                {
                    icon: 'mdi-alert-circle',
                    text: 'Société'
                },
                {
                    icon: 'mdi-alert-circle',
                    text: 'Produits',
                    model: false,
                    children: [{
                            icon_2: 'mdi-circle-medium',
                            text: 'Ajout'
                        },
                        {
                            icon_2: 'mdi-circle-medium',
                            text: 'Modification'
                        },
                        {
                            icon_2: 'mdi-circle-medium',
                            text: 'Print'
                        },
                        {
                            icon_2: 'mdi-circle-medium',
                            text: 'Undo changes'
                        },
                        {
                            icon_2: 'mdi-circle-medium',
                            text: 'Test'
                        },
                    ],
                },
                {
                    icon: 'mdi-alert-circle',
                    text: 'Test'
                }, {
                    icon: 'mdi-account-circle-outline',
                    text: 'Accueil'
                },
                {
                    icon: 'mdi-history',
                    text: 'Qualité'
                },
                {
                    icon: 'mdi-alert-circle',
                    text: 'Société'
                },
                {
                    icon: 'mdi-alert-circle',
                    text: 'Produits',
                    model: false,
                    children: [{
                            icon_2: 'mdi-circle-medium',
                            text: 'Ajout'
                        },
                        {
                            icon_2: 'mdi-circle-medium',
                            text: 'Modification'
                        },
                        {
                            icon_2: 'mdi-circle-medium',
                            text: 'Print'
                        },
                        {
                            icon_2: 'mdi-circle-medium',
                            text: 'Undo changes'
                        },
                        {
                            icon_2: 'mdi-circle-medium',
                            text: 'Test'
                        },
                    ],
                },
                {
                    icon: 'mdi-alert-circle',
                    text: 'Test'
                },
            ],
        }
    },

    methods: {
        switchToTeam(team) {
            this.$inertia.put(route('current-team.update'), {
                'team_id': team.id
            }, {
                preserveState: false
            })
        },
        logout() {
            axios.post(route('logout').url()).then(response => {
                window.location = '/';
            })
        },
    }
}
</script>
