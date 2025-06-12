<template>
  <v-container>
    <h2>Invoices</h2>
    <v-data-table
      :headers="headers"
      :items="invoices"
      height="250px"
      fixed-header
      hide-default-footer=""
    >
      <!-- <thead>
        <tr>
          <th>ID</th>
          <th>Patient ID</th>
          <th>Amount</th>
          <th>Status</th>
          <th>Issued At</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="invoice in invoices" :key="invoice.id">
          <td>{{ invoice.id }}</td>
          <td>{{ invoice.patientId }}</td>
          <td>{{ invoice.amount }}</td>
          <td>{{ invoice.status }}</td>
          <td>{{ invoice.issuedAt }}</td>
        </tr>
      </tbody> -->
      <template #item.patientId="{ item }"> {{ item.patientId }} </template>
      <template #item.amount="{ item }"> $ {{ item.amount.toFixed(2) }} </template>
      <template #item.status="{ item }">
        {{ item.status }}
      </template>
      <template #item.issuedAt="{ item }">
        {{ item.issuedAt }}
      </template>
      <template #item.actions="{ item }">
        <div class="d-flex ga-2 justify-start">
          <v-icon
            color="medium-emphasis"
            icon="mdi-pencil"
            size="small"
            @click="edit(item.id)"
          ></v-icon>

          <v-icon
            color="medium-emphasis"
            icon="mdi-delete"
            size="small"
            @click="remove(item.id)"
          ></v-icon>
        </div>
      </template>
    </v-data-table>
  </v-container>
</template>

<!-- <script>
import api from '../services/api'

export default {
  data() {
    return {
      invoices: [],
    }
  },
  async mounted() {
    const response = await api.get('/invoices')
    this.invoices = response.data
  },
}
</script> -->
<script setup>
import api from '@/services/api'
import { onMounted, ref } from 'vue'

const invoices = ref([])

const headers = [
  {
    title: 'Id',
    key: 'id',
  },
  {
    title: 'Patient Id',
    key: 'patientId',
  },
  {
    title: 'Amount',
    key: 'amount',
  },
  {
    title: 'Status',
    key: 'status',
  },
  {
    title: 'Issued At',
    key: 'issuedAt',
  },
  {
    title: 'Actions',
    align: 'start',
    key: 'actions',
  },
]
const fetchInvoices = async () => {
  const res = await api.get(`/invoices`)
  if (res.status === 200) {
    invoices.value = res.data
  }
}

onMounted(() => {
  fetchInvoices()
})

const edit = (id) => {
  console.log('editing', id)
}

const remove = (id) => {
  console.log('editing', id)
}
</script>
