<!--<template>-->
    <!--<div class="container">-->
        <!--<div class="row justify-content-center">-->
            <!--<div class="col-md-8">-->
                <!--<div class="card">-->
                    <!--<div class="card-header">Exaaa</div>-->

                    <!--<div class="card-body">-->
                        <!--<li v-for="notification in notifications">-->
                            <!--{{notification.data}}-->
                        <!--</li>-->
                    <!--</div>-->
                <!--</div>-->
            <!--</div>-->
        <!--</div>-->
    <!--</div>-->
<!--</template>-->

<!--<script>-->
    <!--export default {-->
        <!--data(){-->
            <!--return{-->
                <!--notifications: null-->
            <!--}-->
        <!--},-->
        <!--mounted() {-->

            <!--Echo.private('user_notifications')-->
                <!--.listen('TaskCompletedEvent', (e) => {-->
                    <!--console.log(e.user);-->
                <!--});-->

            <!--//-->
            <!--// Echo.private(`App.User.${userId}`)-->
            <!--//     .notification((notification) => {-->
            <!--//         console.log(notification.type);-->
            <!--//     });-->

            <!--// Echo.join('notifacations')-->
            <!--//     .here((notifications)=>{-->
            <!--//         this.notifications = notifications-->
            <!--//     })-->
            <!--//     .joining((notification)=>{-->
            <!--//         this.notifications.push(notification)-->
            <!--//     })-->
            <!--//     .leaving((notification)=>{-->
            <!--//         this.notifications.splice(this.notifications.indexOf(notification,1))-->
            <!--//     })-->


        <!--}-->
    <!--}-->
<!--</script>-->
