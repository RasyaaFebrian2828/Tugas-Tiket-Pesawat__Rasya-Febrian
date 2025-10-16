    <?php
    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use App\Models\Penerbangan;
    use App\Models\KelasPenerbangan;

    class PenerbanganController extends Controller
    {
        public function index(){
            $list = Penerbangan::with('kelas')->latest()->get();
            return view('admin.penerbangan.index', compact('list'));
        }

        public function create(){ return view('admin.penerbangan.create'); }

        public function store(Request $r){
            $r->validate([
                'kode_penerbangan'=>'required|unique:penerbangans,kode_penerbangan',
                'asal'=>'required','tujuan'=>'required','waktu_berangkat'=>'required','waktu_tiba'=>'required','harga'=>'required|integer'
            ]);
            Penerbangan::create($r->only(['kode_penerbangan','maskapai','asal','tujuan','waktu_berangkat','waktu_tiba','durasi_menit','harga','kursi_tersedia']));
            return redirect()->route('penerbangan.index')->with('success','Penerbangan ditambahkan');
        }

        public function edit($id){ $p = Penerbangan::findOrFail($id); return view('admin.penerbangan.edit', compact('p')); }

        public function update(Request $r,$id){
            $p = Penerbangan::findOrFail($id);
            $p->update($r->only(['kode_penerbangan','maskapai','asal','tujuan','waktu_berangkat','waktu_tiba','durasi_menit','harga','kursi_tersedia']));
            return redirect()->route('penerbangan.index')->with('success','Diupdate');
        }

        public function destroy($id){ Penerbangan::destroy($id); return back()->with('success','Dihapus'); }

        public function storeKelas(Request $r,$id){
            $r->validate(['nama_kelas'=>'required','harga'=>'required|integer','jumlah_kursi'=>'required|integer']);
            KelasPenerbangan::create(['penerbangan_id'=>$id,'nama_kelas'=>$r->nama_kelas,'harga'=>$r->harga,'jumlah_kursi'=>$r->jumlah_kursi,'sisa_kursi'=>$r->jumlah_kursi]);
            $p = Penerbangan::findOrFail($id); $p->increment('kursi_tersedia',$r->jumlah_kursi);
            return back()->with('success','Kelas ditambahkan');
        }
    }
