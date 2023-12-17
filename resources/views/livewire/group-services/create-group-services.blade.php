<div>

    {{--    @if ($ServiceSaved)
            <div class="alert alert-info">تم حفظ البيانات بنجاح.</div>
        @endif

        @if ($ServiceUpdated)
            <div class="alert alert-info">تم تعديل البيانات بنجاح.</div>
        @endif

        @if($show_table)
            @include('livewire.GroupServices.index')
        @else--}}


    <form wire:submit.prevent="saveGroup" autocomplete="off">
        @csrf

        <div class="form-group">
            <label>اسم المجموعة</label>
            <input wire:model="form.name_group" type="text" name="name_group" class="form-control" required>
        </div>
        <div>
            @error('form.name_group') <span class="error" style="color: red" >{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label>ملاحظات</label>
            <textarea wire:model="form.notes" name="notes" class="form-control" rows="5" required></textarea>
        </div>
        <div>
            @error('form.notes') <span class="error" style="color: red">{{ $message }}</span> @enderror
        </div>

        <div class="card mt-4">

            <div class="card-header">
                <div class="col-md-12">
                    <button class="btn btn-outline-primary"
                            wire:click.prevent="addService">اضافة خدمة فرعية
                    </button>
                </div>
            </div>


            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <tr class="table-primary">
                            <th>اسم الخدمة</th>
                            <th> السعر</th>
                            <th width="200">العدد</th>
                            <th width="200">العمليات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($groupServices as $key =>$value)

                            <tr>
                                <td>
                                    @if(!$groupServices[$key]['is_saved'] == true)
                                        <select name="groupServices[{{$key}}][service_id]" class="form-control{{ $errors->has('groupServices.' . $key) ? ' is-invalid' : '' }}"
                                                wire:model="groupServices.{{$key}}.service_id" wire:change="clickService({{$key}})"  >
                                            <option value="" style="display:none">-- choose product --</option>
                                            @foreach ($this->allServices as $service)
                                                <option value="{{ $service->id }}">{{$service->name}}</option>
                                            @endforeach
                                        </select>
                                        @if($errors->has('groupServices.' . $key))
                                            <em class="invalid-feedback">
                                                {{ $errors->first('groupServices.' . $key) }}
                                            </em>
                                        @endif
                                    @else
                                        {{$groupServices[$key]['service_name']}}
                                    @endif
                                </td>
                                <td>{{$groupServices[$key]['service_price']}}</td>
                                <td>
                                    @if(!$groupServices[$key]['is_saved'] == true)
                                    <input type="number" min="1" name="groupServices[{{$key}}][quantity]" class="form-control" wire:model="groupServices.{{$key}}.quantity" wire:change="clickService({{$key}})" />
                                    @else
                                    {{$groupServices[$key]['quantity']}}
                                    @endif
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-danger" wire:click.prevent="removeService({{$key}})">حذف</button>
                                    @if($groupServices[$key]['is_saved'] == true && $groupServices[$key]['service_id'])
                                        <button class="btn btn-sm btn-primary" wire:click.prevent="editService({{$key}})">تعديل</button>
                                    @else
                                        <button class="btn btn-sm btn-success mr-1" wire:click.prevent="saveService({{$key}})">تاكيد</button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                                <div class="col-lg-4 ml-auto text-right">
                                    <table class="table pull-right">
                                        <tr>
                                            <td style="color: red">الاجمالي</td>
                                            <td>{{ $totalPriceBeforDiscount ? $totalPriceAfterDiscount : $totalPriceBeforDiscount }}</td>
                                        </tr>
                                        <tr>
                                            <td style="color: red">قيمة الخصم</td>
                                            <td width="125">
                                                <input type="number" name="discount_value" class="form-control w-75 d-inline" wire:model="form.discount_value" wire:change="servicePrice">

                                            </td>

                                        </tr>
                                        <tr>
                                            <td style="color: red">نسبة الضريبة</td>
                                            <td>
                                                <input type="number" name="taxes" class="form-control w-75 d-inline" min="0" max="100" wire:model="form.taxes" wire:change="servicePrice"> %
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="color: red">الاجمالي مع الضريبة</td>
                                            <td>{{ $totalPriceAfterTax ? $totalPriceAfterTax : $totalPriceBeforDiscount }}</td>

                                        </tr>
                                    </table>
                                </div>
                <br/>
                <div>
                    <input class="btn btn-outline-success" type="submit" value="تاكيد البيانات">
                </div>
            </div>
        </div>

    </form>


    {{--@endif--}}


</div>
