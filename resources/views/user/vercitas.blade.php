<x-app-layout>
    <!-- This example requires Tailwind CSS v2.0+ -->
    <div class="card-body" style="background: white">
        <div class="container py-8">
            <div class="flex flex-col">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <p class="text text-3xl" style="padding: 0px 10px 10px 75px">
                            Citas reservadas
                        </p>
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                            <table id="tcitas" class="table table-hover min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Fecha</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Hora Inicio</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Hora Fin</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Especialidad</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Doctor</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Estado</th>
                                        <th scope="col" class="relative px-6 py-3"></th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($citas as $meeting)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">
                                                {{$meeting->schedule->fecha_atencion}}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">
                                                {{$meeting->schedule->hora_inicio}}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">
                                                {{$meeting->schedule->hora_fin}}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @foreach ($meeting->schedule->doctor->specialities as $esp)
                                            <div class="text-sm text-gray-900">
                                                {{$esp->nombre}}
                                            </div>
                                            @endforeach
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">
                                                {{$meeting->schedule->doctor->user->name}}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if ($meeting->estado==0)
                                            <span class="text-success text-sm text-gray-900">PENDIENTE</span>
                                            @elseif ($meeting->estado==1)
                                            <span class="text-warning text-sm text-gray-900">FINALIZADO</span>
                                            @else
                                            <span class="text-danger text-sm text-gray-900">CANCELADO</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-left text-sm font-medium">
                                            {{-- Eliminar Cita --}}
                                            <form action="{{ route('cita.ver.destroy', $meeting, Auth::user()->id) }}"
                                                method="post">
                                                @csrf
                                                @method('DELETE')
                                                <input type="submit" value="Cancelar" class="bg-white hover:bg-gray-100
                                                    text-indigo-600 font-semibold py-2 px-4 border border-gray-400 rounded
                                                    shadow">
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
          $('#tcitas').DataTable({
                "responsive":true,
                "auto-with":false,
                "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
                }
            });
        });
    </script>
</x-app-layout>
