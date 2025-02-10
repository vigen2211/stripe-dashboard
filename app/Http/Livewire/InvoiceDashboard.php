<?php

namespace App\Http\Livewire;

use Livewire\Component;

class InvoiceDashboard extends Component
{
    public $activeTab = 'all';

    public $dropdownInvoiceId = null;

    public $invoices = [
        ['id' => 1, 'amount' => '$200', 'invoice_number' => 'INV001', 'email' => 'customer1@example.com', 'status' => 'Paid', 'date' => '2024-02-01'],
        ['id' => 2, 'amount' => '$350', 'invoice_number' => 'INV002', 'email' => 'customer2@example.com', 'status' => 'Draft', 'date' => '2024-02-05'],
        ['id' => 3, 'amount' => '$150', 'invoice_number' => 'INV003', 'email' => 'customer3@example.com', 'status' => 'Outstanding', 'date' => '2024-02-10'],
        ['id' => 4, 'amount' => '$450', 'invoice_number' => 'INV004', 'email' => 'customer4@example.com', 'status' => 'Paid', 'date' => '2024-02-12'],
        ['id' => 5, 'amount' => '$500', 'invoice_number' => 'INV005', 'email' => 'customer5@example.com', 'status' => 'Outstanding', 'date' => '2024-02-15'],
    ];

    public function setTab($tab)
    {
        $this->activeTab = $tab;
    }

    public function toggleDropdown($invoiceId)
    {
        $this->dropdownInvoiceId = $this->dropdownInvoiceId === $invoiceId ? null : $invoiceId;
    }

    public function closeDropdown()
    {
        $this->dropdownInvoiceId = null;
    }

    public function getFilteredInvoices()
    {
        if ($this->activeTab === 'all') return $this->invoices;
        return array_filter($this->invoices, fn($invoice) => strtolower($invoice['status']) === strtolower($this->activeTab));
    }

    public function render()
    {
        return view('livewire.invoice-dashboard', [
            'filteredInvoices' => $this->getFilteredInvoices(),
        ]);
    }
}

