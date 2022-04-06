<template>
    <div class="p-5 text-center img-fluid">
        <img src="template/images/svg/no-data.svg" width="500" alt="">
        <h6 class="mt-3 text-danger">
            {{message}}
        </h6>

    </div>
</template>

<script>
export default {
    name: "Front_NoData",
    props : ['message']
}
</script>

<style scoped>

</style>
