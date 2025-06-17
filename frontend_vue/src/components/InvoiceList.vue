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
      <template #item.email="{ item }">
        {{ item.patient_email }}
      </template>
      <template #item.description="{ item }">
        {{ item.description }}
      </template>
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
            @click="edit(item)"
          ></v-icon>

          <v-icon
            color="medium-emphasis"
            icon="mdi-delete"
            size="small"
            @click="remove(item.id)"
          ></v-icon>

          <v-icon
            color="medium-emphasis"
            icon="mdi-email"
            size="small"
            @click="emailInvoice(item.id)"
          ></v-icon>
        </div>
      </template>
    </v-data-table>

    <v-dialog v-model="dialog" max-width="450" @after-leave="onAfterLeave">
      <v-card density="compact" title="Edit">
        <v-divider />
        <v-card-text>
          <v-text-field v-model="invoices.amount" density="compact" label="Amount" />
          <v-text-field v-model="invoices.issuedAt" density="compact" label="Date" />
        </v-card-text>
        <v-card-actions>
          <v-spacer />
          <v-icon
            :loading="isSaving"
            color="primary"
            icon="mdi-content-save"
            variant="flat"
            @click="save"
          />
        </v-card-actions>
        <v-snackbar v-model="snackbar.show" :color="snackbar.color" timeout="3000">
          {{ snackbar.message }}
        </v-snackbar>
      </v-card>
    </v-dialog>
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
import invoiceService from '@/services/invoiceService'
import { onMounted, ref } from 'vue'

const invoices = ref([])
const dialog = ref(false)
const isSaving = ref(false)

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
    title: 'Email',
    key: 'email',
  },
  {
    title: 'Description',
    key: 'description',
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

const edit = (item) => {
  console.log('editing', item)
  dialog.value = true
  invoices.value = [{ ...item }]
}

const remove = (id) => {
  console.log('editing', id)
}

const onAfterLeave = () => {
  invoices.value = headers
}

const save = async () => {
  isSaving.value = true
  // await new Promise(resolve => setTimeout(resolve, 1000))
  // const index = invoices.
  console.log(invoices.value)
}

const snackbar = ref({
  show: false,
  message: '',
  color: 'success', // or 'error'
})

const showSnackbar = (message, color = 'success') => {
  snackbar.value.message = message
  snackbar.value.color = color
  snackbar.value.show = true
}

const emailInvoice = async (invoiceId) => {
  try {
    await invoiceService.sendInvoiceEmail(invoiceId)
    showSnackbar('Invoice emailed successfully!')
  } catch (error) {
    showSnackbar(error.message || 'Failed to send invoice email.', 'error')
  }
}
</script>
