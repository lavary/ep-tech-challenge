<template>
    <div>
        <h1 class="mb-6">Clients -> Add New Client</h1>
        <div class="max-w-lg mx-auto">
            <form @submit.prevent="storeClient">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" class="form-control" maxlength="190" required v-model="client.name">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" class="form-control" v-model="client.email">
            </div>
            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="tel" id="phone" class="form-control" pattern="^\+?\d[\d\s]*$" v-model="client.phone">
            </div>
            <div class="form-group">
                <label for="name">Address</label>
                <input type="text" id="address" class="form-control" v-model="client.address">
            </div>
            <div class="flex">
                <div class="form-group flex-1">
                    <label for="city">City</label>
                    <input type="text" id="city" class="form-control" v-model="client.city">
                </div>
                <div class="form-group flex-1">
                    <label for="postcode">Postcode</label>
                    <input type="text" id="postcode" class="form-control" v-model="client.postcode">
                </div>
            </div>

            <div class="text-right">
                <a href="/clients" class="btn btn-default">Cancel</a>
                <button class="btn btn-primary">Create</button>
            </div>
            </form>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    name: 'ClientForm',

    data() {
        return {
            client: {
                name: '',
                email: '',
                phone: '',
                address: '',
                city: '',
                postcode: '',
            }
        }
    },

    methods: {
        async storeClient() {
            if (!this.client.email && !this.client.phone) {
                this.$toast.error("Phone or email required!");
                return
            }

            const data = await axios.post('/clients', this.client)

            if (data.status !== 201) {
                this.$toast.error("Something is wrong!");
                return
            }

            window.location.href = data.data.url;
        }
    }
}
</script>
