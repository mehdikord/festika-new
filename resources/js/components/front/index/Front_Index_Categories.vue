<template>
    <div class="featured-area pt-70 pb-70">
        <div class="container">
            <div class="tab featured-tab-area">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-4">
                        <div class="section-title">
                            <h1 class="text-aviny font-40 text-danger">دسته بندی جشنواره ها </h1>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-8">
                        <ul class="nav tabs">
                            <li>
                                <a href="#" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home">
                                    All
                                </a>
                            </li>
                            <li>
                                <a href="#" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile">
                                    Art
                                </a>
                            </li>
                            <li>
                                <a href="#" id="messages-tab" data-bs-toggle="tab" data-bs-target="#messages" type="button" role="tab" aria-controls="messages">
                                    Virtual Worlds
                                </a>
                            </li>
                            <li>
                                <a href="#" id="settings-tab" data-bs-toggle="tab" data-bs-target="#settings" type="button" role="tab" aria-controls="settings">
                                    Collectibles
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    Music
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="col-12">

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane active" id="home" role="tabpanel" aria-labelledby="home-tab">

                            </div>
                            <div class="tab-pane" id="profile" role="tabpanel" aria-labelledby="profile-tab">

                            </div>
                            <div class="tab-pane" id="messages" role="tabpanel" aria-labelledby="messages-tab">

                            </div>
                            <div class="tab-pane" id="settings" role="tabpanel" aria-labelledby="settings-tab">

                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Front_Index_Categories"
}
</script>

<style scoped>

</style>
