<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <tabs :selected="currentTab"
                      :role="userRole"
                      @onChange="changeTab"></tabs>
            </div>
            <div class="col-md-4" v-if="isQa">
                <a class="d-block btn btn-primary ml-auto"
                  href="/report-bug"
                >Create Bug</a>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-6">
                <div class="list-group">
                    <a class="list-group-item list-group-item-action"
                       @click.prevent="selectedBug = bug"
                       v-for="bug in bugs" :key="bug.id">
                        {{ bug.summary }}
                    </a>

                </div>
            </div>
            <div class="col-md-6 border border-grey p-3 rounded" v-if="selectedBug">
                <div class="mt-3" style="font-size: 10px">
                    <div>
                        Created By: {{selectedBug.created_user.name}}
                    </div>
                    <div v-if="selectedBug.resolved_user">
                        Resolved By: {{selectedBug.resolved_user.name}}
                    </div>
                    <div v-if="selectedBug.resolved_at">
                        Resolved At: {{ selectedBug.resolved_at }}
                    </div>
                </div>
                <div class="form-floating my-3">
                    <label for="summary">Summary</label>
                    <textarea class="form-control"
                              v-model="selectedBug.summary"
                              :readonly="!isEditable"
                              id="summary"></textarea>
                </div>
                <div class="form-floating">
                    <label for="description">Description</label>
                    <textarea class="form-control"
                              :readonly="!isEditable"
                              v-model="selectedBug.description"
                              id="description"></textarea>
                </div>

                <div class="mt-3" v-if="isRd">
                    <button class="d-block ml-auto btn btn-primary"
                            @click="markBug('PROCESSING')"
                            v-if="isSelectedBugOnPending">
                        💪 Start Fixing
                    </button>
                    <button class="d-block ml-auto btn btn-primary"
                            @click="markBug('RESOLVED')"
                            v-if="isSelectedBugOnProcessing">
                        ✅ Report Fixed
                    </button>
                </div>
                <div class="mt-3 d-flex justify-content-end" v-if="isQa">
                    <button class="btn btn-info d-block mr-3" @click="updateBug">
                        Update Bug
                    </button>
                    <button class="btn btn-danger d-block" @click="deleteBug">
                        Remove Bug
                    </button>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
    export default {
        data: () => ({
            user: null,
            bugs: [],
            selectedBug: null,
            currentTab: 'PENDING',
        }),
        methods: {
            changeTab(tab) {
                this.currentTab = tab;
                this.selectedBug = null;
                this.loadData();
            },
            loadData() {
                axios.get(`/api/bugs?status=${this.currentTab}`)
                    .then(res => this.bugs = res.data.data)
                    .catch(err => alert(err));
            },

            markBug(status) {
                if (!this.selectedBug) {
                    return;
                }

                if (!window.confirm(`Are you sure to update to ${status} ?`)) {
                    return;
                }

                axios.patch(`/api/bugs/${this.selectedBug.id}/mark`, { status })
                    .then(() => {
                        this.removeSelectedBugFromList();
                    })
                    .catch(err => alert(err));
            },

            updateBug() {
                if (!this.selectedBug) {
                    return;
                }

                if (!window.confirm('Are you sure to update this bug ?')) {
                    return;
                }

                // Todo: to validate the input values
                const { summary, description } = this.selectedBug;
                axios.patch(`/api/bugs/${this.selectedBug.id}`, { summary, description })
                    .then(res => this.bugs = res.data.data)
                    .catch(err => alert(err));
            },
            removeSelectedBugFromList() {
                const idx = this.bugs.findIndex(bug => bug.id === this.selectedBug.id);
                if (idx > -1) {
                    this.bugs.splice(idx, 1);
                    this.selectedBug = null;
                }
            },
            deleteBug() {
                if (!this.selectedBug) {
                    return;
                }

                if (!window.confirm('Are you sure to delete this bug ?')) {
                    return;
                }

                axios.delete(`/api/bugs/${this.selectedBug.id}`)
                    .then(() => {
                        this.removeSelectedBugFromList();
                    })
                    .catch(err => alert(err));
            },
        },
        computed: {
            isEditable() {
                return this.isQa
                    && this.selectedBug
                    && this.selectedBug.created_user.id === this.user.id;
            },
            userRole() {
                return this.user ? this.user.role.name : null;
            },
            isQa() {
                return this.user && this.userRole === 'QA';
            },
            isRd() {
                return !this.isQa && this.userRole === 'RD';
            },
            isSelectedBugOnPending() {
                return this.selectedBug && this.selectedBug.status === 'PENDING';
            },
            isSelectedBugOnProcessing() {
                return this.selectedBug && this.selectedBug.status === 'PROCESSING';
            },

        },
        created() {
            axios.get('/api/user')
                .then(res => this.user = res.data.data)
                .catch(err => alert(err));
            this.loadData();
        },
    }
</script>
