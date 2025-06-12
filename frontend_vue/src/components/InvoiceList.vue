<template>
  <v-container>
    <h2>Invoices</h2>
    <v-data-table height="250px" fixed-header>
      <thead>
        <tr>
          <th>ID</th>
          <th>Patient ID</th>
          <th>Amount</th>
          <th>Status</th>
          <th>Issued At</th>
          <th>Actions</th>
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
      </tbody>
    </v-data-table>
  </v-container>
</template>

<script>
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
</script>
