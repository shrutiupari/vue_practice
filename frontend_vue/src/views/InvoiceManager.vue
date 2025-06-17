<template>
  <div>
    <InvoiceForm @invoiceCreated="fetchInvoices" />
    <ul v-if="invoices.length">
      <li v-for="inv in invoices" :key="inv.id">{{ inv.number }} - ₹{{ inv.amount }}</li>
    </ul>
    <p v-else>No invoices yet</p>
  </div>
</template>

<script>
import InvoiceForm from '@/components/InvoiceForm.vue'
import invoiceService from '@/services/invoiceService'

export default {
  components: { InvoiceForm },
  data() {
    return {
      invoices: [],
    }
  },
  created() {
    this.fetchInvoices()
  },
  methods: {
    async fetchInvoices() {
      const res = await invoiceService.list()
      this.invoices = res.data
    },
  },
}
</script>
