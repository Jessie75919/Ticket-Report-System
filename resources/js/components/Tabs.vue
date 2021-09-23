<template>
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link" :class="{'active': selected === 'PENDING'}"
               @click="changeTab('PENDING')">{{ pendingBugs }}</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" :class="{'active': selected === 'PROCESSING'}"
               @click="changeTab('PROCESSING')">{{ processingBugs }}</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" :class="{'active': selected === 'RESOLVED'}"
               @click="changeTab('RESOLVED')">{{ resolvedBugs }}</a>
        </li>
    </ul>
</template>

<script>
export default {
    name: 'Tabs',
    props: {
        selected: {
            type: String,
            default: 'PENDING',
        },
        role: {
            type: String,
        }
    },
    methods: {
        changeTab(tab) {
            this.$emit('onChange', tab);
        },
    },
    computed:{
        pendingBugs(){
            return this.role === 'QA' ? "My Pending Bugs" : "All Pending Bugs"
        },
        processingBugs(){
            return this.role === 'QA' ? "My Processing Bugs" : "My Fixing Bugs"
        },
        resolvedBugs() {
            return this.role === 'QA' ? "My Resolved Bugs" : "My Fixed Bugs"
        },
    }
};
</script>

<style scoped>

</style>
