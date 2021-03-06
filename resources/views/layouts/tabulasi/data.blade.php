<div class="form-group">
    <div class="form-line" style="overflow-x: scroll;">
        <table id="data_suara" class="table table-bordered" style="cursor: pointer;">
            <thead>
              <tr class="bg-blue" style="color: white;">
                <th class="tg-yw4l">Calon</th>
                @foreach($tps as $data)
                    <th class="tg-yw4l">X{{ $data }}</th>
                @endforeach
              </tr>
            </thead>
            <tbody>
              @if($calon)
                @foreach($calon as $data_calon)
                  <tr>
                    <td class="tg-yw4l" tabindex="1">
                      @if($data_calon->has_wakil)
                        {{ $data_calon->nama . ' - ' . $data_calon->wakil->nama }}
                      @else
                        {{ $data_calon->nama }}
                      @endif
                    </td>
                    @foreach($tps as $data)
                        @if(!empty($data_suara))
                        <td class="tg-yw4l" tabindex="1">
                          <input name="tabulasi[{{ $data_calon->id }}][{{ $data }}]" type="number" style="border:none" value="{{ $data_suara[''.$data_calon->id.''][$data] }}">
                        </td>
                        @else
                        <td class="tg-yw4l" tabindex="1">
                          <input name="tabulasi[{{ $data_calon->id }}][{{ $data }}]" type="number" style="border:none" value="0">
                        </td>
                        @endif
                    @endforeach
                  </tr>
                @endforeach
              @endif
            </tbody>

        </table>
    </div>
</div>
