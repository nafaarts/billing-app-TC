@extends('_layouts.master')

@section('body')
    <style>
        #dashboard * {
            transition: 1s
        }

    </style>
    <div id="dashboard">
        <section id="info-card" class="flex">
            <div class=" p-5 md:w-1/4 w-2/4 bg-white rounded-lg m-1">
                <small class="text-gray-400">Total Invoiced</small>
                <h1 class="text-xl font-bold text-gray-700">1.636.630.088</h1>
            </div>
            <div class=" p-5 md:w-1/4 w-2/4 bg-white rounded-lg m-1">
                <small class="text-gray-400">Total Received</small>
                <h1 class="text-xl font-bold text-gray-700">966.030.088</h1>
            </div>
            <div class=" p-5 md:w-1/4 w-2/4 bg-white rounded-lg m-1">
                <small class="text-gray-400">Total Pending</small>
                <h1 class="text-xl font-bold text-gray-700">670.600.000</h1>
            </div>
            <div class=" p-5 md:w-1/4 w-2/4 bg-white rounded-lg m-1">
                <small class="text-gray-400">Client / Invoices</small>
                <h1 class="text-xl font-bold text-gray-700">89 / 1878</h1>
            </div>
        </section>

        <section id="graph" class="flex">
            <div class="chart1 md:w-1/2 w-full overflow-hidden bg-white rounded-lg p-2 m-1">
                <canvas id="InvoiceChart"></canvas>
            </div>
            <div class="chart2 md:w-1/2 w-full overflow-hidden bg-white rounded-lg p-2 m-1">
                <canvas id="ReimbursmentChart"></canvas>
            </div>
        </section>

        <script>
            let testData1 = []
            let testData2 = []
            let testData = []
            let testData3 = []
            let delayed;
            let delayed2;
            refreshData()

            const InvoiceChart = document.getElementById('InvoiceChart').getContext('2d');
            const generateNumber = (from, to, n) => {
                let data = []
                for (let i = 0; i < n; i++) {
                    data.push(Math.random() * (to - from) + from)
                }
                return data
            }

            const data1 = {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct',
                    'Nov', 'Dec'
                ],
                datasets: [{
                    label: 'Value of Invoice',
                    data: testData1,
                    borderColor: 'rgba(255, 99, 132, 1)',
                    backgroundColor: 'rgba(255, 99, 132, 0.2)'
                }, {
                    label: 'Value of Reimbursment',
                    data: testData2,
                    borderColor: 'rgba(54, 162, 235, 1)',
                    backgroundColor: 'rgba(54, 162, 235, 0.2)'
                }]
            };
            const myInvoiceChart = new Chart(InvoiceChart, {
                type: 'line',
                data: data1,
                options: {
                    animation: {
                        onComplete: () => {
                            delayed = true;
                        },
                        delay: (context) => {
                            let delay = 0;
                            if (context.type === 'data' && context.mode === 'default' && !delayed) {
                                delay = context.dataIndex * 200 + context.datasetIndex * 100;
                            }
                            return delay;
                        },
                    },
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        title: {
                            display: true,
                            text: 'Value 2021'
                        }
                    }
                },
            });

            const ReimbursmentChart = document.getElementById('ReimbursmentChart').getContext('2d');
            const data2 = {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct',
                    'Nov', 'Dec'
                ],
                datasets: [{
                    label: 'Total Invoice',
                    data: testData,
                    borderColor: 'rgba(255, 99, 132, 1)',
                    backgroundColor: 'rgba(255, 99, 132, 0.7)'
                }, {
                    label: 'Total Reimbursment',
                    data: testData3,
                    borderColor: 'rgba(54, 162, 235, 1)',
                    backgroundColor: 'rgba(54, 162, 235, 0.7)'
                }]
            };

            const myReimbursmentChart = new Chart(ReimbursmentChart, {
                type: 'bar',
                data: data2,
                options: {
                    animation: {
                        onComplete: () => {
                            delayed2 = true;
                        },
                        delay: (context) => {
                            let delay = 0;
                            if (context.type === 'data' && context.mode === 'default' && !delayed2) {
                                delay = context.dataIndex * 300 + context.datasetIndex * 100;
                            }
                            return delay;
                        },
                    },
                    responsive: true,
                    plugins: {

                        legend: {
                            position: 'top',
                        },
                        title: {
                            display: true,
                            text: 'Invoice 2021'
                        }
                    }
                },
            });

            function refreshData() {
                for (let index = 0; index < 12; index++) {
                    testData[index] = Math.floor(Math.floor(Math.random() * 2 + 3)) * 74
                    testData3[index] = Math.floor(Math.floor(Math.random() * 2 + 3)) * 74
                    testData1[index] = (Math.floor(Math.random() * 10 + 3) / 2) * 10000000
                    testData2[index] = (Math.floor(Math.random() * 10 + 3) / 2) * 10000000
                }
            }

            setInterval(() => {
                refreshData();
                myReimbursmentChart.update();
                myInvoiceChart.update();
            }, 3000);
        </script>

        <section>
            <div class="overflow-x-auto m-1">
                <div
                    class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
                    <table class="min-w-full">
                        <thead>
                            <tr>
                                <th
                                    class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    invoice</th>

                                <th
                                    class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    Total</th>

                                <th
                                    class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    Detail</th>

                                <th
                                    class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    Added by</th>

                                <th
                                    class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    Action</th>

                            </tr>
                        </thead>
                        <tbody class="bg-white">
                            <tr class="hover:bg-gray-100">
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-sm font-bold text-gray-900">
                                        R-JKT-18239
                                    </div>
                                    <div class="text-sm leading-5 text-gray-500">PT INDO MURO KENCANA
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-sm font-bold text-gray-900">
                                        Rp. 520.000.000
                                    </div>
                                    <div class="text-xs text-gray-900">
                                        Items : <strong>7 items</strong>
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-xs text-gray-900">
                                        Job Ref : <strong>22111-022, 52109-023</strong><br>
                                        Terms : <strong>COD</strong><br>
                                        Date : <strong>3 Nov 2021</strong>
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-sm font-bold text-gray-700">
                                        Naufal
                                    </div>
                                    <div class="text-sm leading-5 text-gray-500">
                                        2 hours ago
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-xs font-medium">
                                    <a href=""
                                        class="py-2 px-4 border-2 border-red-500 rounded-lg text-red-500 hover:text-white hover:bg-red-500">Open
                                        Invoice</a>
                                </td>
                            </tr>
                            <tr class="hover:bg-gray-100">
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-sm font-bold text-gray-900">
                                        R-JKT-18239
                                    </div>
                                    <div class="text-sm leading-5 text-gray-500">PT INDO MURO KENCANA
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-sm font-bold text-gray-900">
                                        Rp. 520.000.000
                                    </div>
                                    <div class="text-xs text-gray-900">
                                        Items : <strong>7 items</strong>
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-xs text-gray-900">
                                        Job Ref : <strong>22111-022, 52109-023</strong><br>
                                        Terms : <strong>COD</strong><br>
                                        Date : <strong>3 Nov 2021</strong>
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-sm font-bold text-gray-700">
                                        Naufal
                                    </div>
                                    <div class="text-sm leading-5 text-gray-500">
                                        2 hours ago
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-xs font-medium">
                                    <a href=""
                                        class="py-2 px-4 border-2 border-red-500 rounded-lg text-red-500 hover:text-white hover:bg-red-500">Open
                                        Invoice</a>
                                </td>
                            </tr>
                            <tr class="hover:bg-gray-100">
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-sm font-bold text-gray-900">
                                        R-JKT-18239
                                    </div>
                                    <div class="text-sm leading-5 text-gray-500">PT INDO MURO KENCANA
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-sm font-bold text-gray-900">
                                        Rp. 520.000.000
                                    </div>
                                    <div class="text-xs text-gray-900">
                                        Items : <strong>7 items</strong>
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-xs text-gray-900">
                                        Job Ref : <strong>22111-022, 52109-023</strong><br>
                                        Terms : <strong>COD</strong><br>
                                        Date : <strong>3 Nov 2021</strong>
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-sm font-bold text-gray-700">
                                        Naufal
                                    </div>
                                    <div class="text-sm leading-5 text-gray-500">
                                        2 hours ago
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-xs font-medium">
                                    <a href=""
                                        class="py-2 px-4 border-2 border-red-500 rounded-lg text-red-500 hover:text-white hover:bg-red-500">Open
                                        Invoice</a>
                                </td>
                            </tr>
                            <tr class="hover:bg-gray-100">
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-sm font-bold text-gray-900">
                                        R-JKT-18239
                                    </div>
                                    <div class="text-sm leading-5 text-gray-500">PT INDO MURO KENCANA
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-sm font-bold text-gray-900">
                                        Rp. 520.000.000
                                    </div>
                                    <div class="text-xs text-gray-900">
                                        Items : <strong>7 items</strong>
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-xs text-gray-900">
                                        Job Ref : <strong>22111-022, 52109-023</strong><br>
                                        Terms : <strong>COD</strong><br>
                                        Date : <strong>3 Nov 2021</strong>
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-sm font-bold text-gray-700">
                                        Naufal
                                    </div>
                                    <div class="text-sm leading-5 text-gray-500">
                                        2 hours ago
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-xs font-medium">
                                    <a href=""
                                        class="py-2 px-4 border-2 border-red-500 rounded-lg text-red-500 hover:text-white hover:bg-red-500">Open
                                        Invoice</a>
                                </td>
                            </tr>
                            <tr class="hover:bg-gray-100">
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-sm font-bold text-gray-900">
                                        R-JKT-18239
                                    </div>
                                    <div class="text-sm leading-5 text-gray-500">PT INDO MURO KENCANA
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-sm font-bold text-gray-900">
                                        Rp. 520.000.000
                                    </div>
                                    <div class="text-xs text-gray-900">
                                        Items : <strong>7 items</strong>
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-xs text-gray-900">
                                        Job Ref : <strong>22111-022, 52109-023</strong><br>
                                        Terms : <strong>COD</strong><br>
                                        Date : <strong>3 Nov 2021</strong>
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-sm font-bold text-gray-700">
                                        Naufal
                                    </div>
                                    <div class="text-sm leading-5 text-gray-500">
                                        2 hours ago
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-xs font-medium">
                                    <a href=""
                                        class="py-2 px-4 border-2 border-red-500 rounded-lg text-red-500 hover:text-white hover:bg-red-500">Open
                                        Invoice</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                {{-- {{ $data->links() }} --}}
            </div>
        </section>
    </div>
@endsection
