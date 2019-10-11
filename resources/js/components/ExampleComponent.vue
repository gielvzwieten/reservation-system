<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{title}}</div>

                    <div class="card-body">
                        {{body}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        },

        data: function() {
            return {
                title: 'My first example-component',
                body: 'Hello Body!',
            }
        }
    }
</script>
