import axios from "axios";

export default {
  async getInvoices() {
    const res = await fetch('/api/invoices');
    return await res.json();
  },
  async createInvoice(data) {
    await fetch('/api/invoices', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(data),
    });
  },
  async sendInvoiceEmail(id) {
    try {
      const res = await fetch(`/api/invoices/${id}/send-email`, {
        method: 'POST'
      });
      const result = await res.json();
      console.log(result.status); // 'queued'
    } catch (error) {
      console.error('Email send error:', error);
      throw error;
    }
  }
};