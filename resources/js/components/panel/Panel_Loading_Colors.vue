<template>
<div>
    <div class="text-center img-fluid loading shadow p-1">
        <img src="/management/images/loading-colors.svg" class="img-fluid" :width="size" alt="">
    </div>
</div>
</template>

<script>
export default {
    name: "Manage_Loading",
    props : ['size']
}
</script>

<style scoped>
    .loading{
        background: rgba(0, 0, 0, 0.25);
        border-radius: 5px;
    }
</style>
