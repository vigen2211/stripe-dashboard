<div>
    <div class="max-w-6xl mx-auto p-4">
        <!-- Tabs -->
        <div class="flex space-x-6 border-b pb-3 mb-4">
            @foreach(['all' => 'All Invoices', 'draft' => 'Draft', 'outstanding' => 'Outstanding', 'paid' => 'Paid'] as $key => $label)
                <button wire:click="setTab('{{ $key }}')" class="px-6 py-2 text-sm {{ $activeTab === $key ? 'border-b-4 border-blue-600 text-blue-600 font-semibold' : 'text-gray-500' }} hover:text-blue-600 transition-colors duration-300">
                    {{ $label }}
                </button>
            @endforeach
        </div>

        <!-- Invoice Table -->
        <div>
            <table class="min-w-full bg-white shadow-lg rounded-lg mt-4">
                <thead>
                <tr class="bg-gray-50 text-left text-sm font-medium">
                    <th class="px-6 py-3 text-gray-600">Amount</th>
                    <th class="px-6 py-3 text-gray-600">Invoice #</th>
                    <th class="px-6 py-3 text-gray-600">Customer Email</th>
                    <th class="px-6 py-3 text-gray-600">Status</th>
                    <th class="px-6 py-3 text-gray-600">Created Date</th>
                    <th class="px-6 py-3"></th>
                </tr>
                </thead>
                <tbody>
                @foreach ($filteredInvoices as $invoice)
                    <tr class="border-b">
                        <td class="px-6 py-3">{{ $invoice['amount'] }}</td>
                        <td class="px-6 py-3">{{ $invoice['invoice_number'] }}</td>
                        <td class="px-6 py-3">{{ $invoice['email'] }}</td>
                        <td class="px-6 py-3">
                            <span class="px-3 py-1 text-xs rounded {{ $invoice['status'] === 'Paid' ? 'bg-green-200 text-green-800' : ($invoice['status'] === 'Draft' ? 'bg-yellow-200 text-yellow-800' : 'bg-red-200 text-red-800') }}">
                                {{ $invoice['status'] }}
                            </span>
                        </td>
                        <td class="px-6 py-3">{{ $invoice['date'] }}</td>
                        <td class="px-6 py-3 relative">
                            <!-- Toggle button -->
                            <button wire:click="toggleDropdown({{ $invoice['id'] }})" class="text-gray-500 hover:text-gray-800">
                                ⋮
                            </button>

                            <!-- Dropdown menu -->
                            @if($dropdownInvoiceId === $invoice['id'])
                                <div class="absolute right-0 mt-2 w-32 bg-white shadow-md rounded-md">
                                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-200">Download</a>
                                    <a href="#" class="block px-4 py-2 text-sm text-red-700 hover:bg-gray-200">Delete</a>
                                </div>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>


    <!-- Mobile/Tablet Responsive Adjustments -->
    <style>
        @media (max-width: 768px) {
            .min-w-full {
                min-width: 100%;
            }

            .px-6 {
                padding-left: 1rem;
                padding-right: 1rem;
            }

            .space-x-6 {
                margin-left: -1.5rem;
                margin-right: -1.5rem;
            }

            table {
                display: block;
                overflow-x: auto;
                white-space: nowrap;
            }

            th, td {
                padding: 1rem;
            }

            td {
                text-align: left;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.addEventListener('click', function (event) {
                let dropdown = document.querySelector('.relative .absolute');
                let dropdownButton = document.querySelector('.relative button');
                if (dropdown && !dropdown.contains(event.target) && !dropdownButton.contains(event.target)) {
                @this.closeDropdown();
                }
            });
        });
    </script>
</div>
