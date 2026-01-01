<?php
namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LessonSeeder extends Seeder
{
    public function run(): void
    {
        $now     = Carbon::now();
        $lessons = [];

        // Helper UUID
        $genId = function ($modSuffix, $idx) {
            return 'e0000000-0000-0000-0000-' . $modSuffix . str_pad($idx, 8, '0', STR_PAD_LEFT);
        };

        // =========================================================================
        // COURSE 1: AI & LLM
        // =========================================================================

        // --- Module 1101: Introduction ---
        $lessons[] = [
            'id'       => $genId('1101', 1), 'module_id' => 'd0000000-0000-0000-0000-000000001101',
            'title'    => 'Apa itu Large Language Model (LLM)?',
            'type'     => 'text',
            'content'  => '
                <article class="prose prose-slate max-w-none">
                    <h3>Pengantar Era Generative AI</h3>
                    <p>Large Language Model (LLM) bukan sekadar chatbot. Ini adalah model probabilitas statistik yang dilatih menggunakan arsitektur <strong>Transformer</strong> pada petabyte data teks dari internet. Berbeda dengan program tradisional yang berbasis aturan (rule-based), LLM bekerja dengan memprediksi token (kata/potongan kata) berikutnya berdasarkan konteks sebelumnya.</p>

                    <h4>Arsitektur Transformer</h4>
                    <p>Diperkenalkan oleh Google pada paper "Attention is All You Need" (2017), Transformer memungkinkan model untuk:</p>
                    <ul>
                        <li><strong>Parallel Processing:</strong> Memproses seluruh kalimat sekaligus, bukan kata per kata secara urut (seperti RNN/LSTM).</li>
                        <li><strong>Self-Attention:</strong> Memahami hubungan antar kata yang berjauhan. Contoh: Dalam kalimat "Bank itu memberikan pinjaman karena memiliki aset kuat", model tahu bahwa kata "memiliki" merujuk pada "Bank", bukan "pinjaman".</li>
                    </ul>

                    <h4>Tokenisasi & Embedding</h4>
                    <p>Mesin tidak mengerti teks. Teks diubah menjadi angka melalui proses:</p>
                    <ol>
                        <li><strong>Tokenization:</strong> Memecah teks. "Saya makan" &rarr; ["Saya", "makan"].</li>
                        <li><strong>Embedding:</strong> Mengubah token menjadi vektor (daftar angka) di ruang multidimensi. Kata dengan makna mirip akan memiliki posisi vektor yang berdekatan.</li>
                    </ol>

                    <p>Dalam kursus ini, kita tidak akan melatih model dari nol (Pre-training) karena membutuhkan biaya jutaan dolar. Kita akan fokus pada <strong>Application Layer</strong>: bagaimana memanfaatkan model yang sudah pintar (seperti GPT-4, Claude, Llama) untuk menyelesaikan masalah bisnis nyata.</p>
                </article>
            ',
            'duration' => 15, 'is_preview'               => true, 'sort' => 1, 'created_at' => $now, 'updated_at' => $now,
        ];

        $lessons[] = [
            'id'       => $genId('1101', 2), 'module_id' => 'd0000000-0000-0000-0000-000000001101',
            'title'    => 'Setup Environment & OpenAI API',
            'type'     => 'text',
            'content'  => '
                <article class="prose prose-slate max-w-none">
                    <h3>Persiapan Development Environment</h3>
                    <p>Untuk membangun aplikasi AI, kita membutuhkan bahasa pemrograman yang memiliki ekosistem data science yang kuat. Python adalah standar industri saat ini.</p>

                    <h4>1. Instalasi Python & Virtual Environment</h4>
                    <p>Sangat disarankan menggunakan Virtual Environment agar library tidak bentrok antar project.</p>
                    <pre class="bg-slate-900 text-slate-100 p-4 rounded-lg my-4"><code># Membuat folder project
mkdir ai-app && cd ai-app

# Membuat virtual env
python -m venv venv

# Mengaktifkan (Windows)
venv\Scripts\activate

# Mengaktifkan (Mac/Linux)
source venv/bin/activate</code></pre>

                    <h4>2. Instalasi Library Utama</h4>
                    <p>Kita akan menggunakan <code>openai</code> untuk akses LLM dan <code>python-dotenv</code> untuk keamanan.</p>
                    <pre class="bg-slate-900 text-slate-100 p-4 rounded-lg my-4"><code>pip install openai python-dotenv langchain</code></pre>

                    <h4>3. Manajemen API Key</h4>
                    <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 my-4">
                        <p class="font-bold text-yellow-700">Peringatan Keamanan:</p>
                        <p class="text-sm text-yellow-600">Jangan pernah menulis API Key langsung di dalam kode (Hardcode). Jika kode Anda ter-upload ke GitHub, bot hacker akan mencuri key Anda dalam hitungan detik dan menguras saldo kartu kredit Anda.</p>
                    </div>

                    <p>Buat file bernama <code>.env</code>:</p>
                    <pre class="bg-slate-900 text-slate-100 p-4 rounded-lg"><code>OPENAI_API_KEY=sk-proj-xxxxxxxxxxxxxxxxxxxxxxx</code></pre>

                    <p>Lalu akses di Python:</p>
                    <pre class="bg-slate-900 text-slate-100 p-4 rounded-lg"><code>import os
from dotenv import load_dotenv
load_dotenv()

api_key = os.getenv("OPENAI_API_KEY")</code></pre>
                </article>
            ',
            'duration' => 10, 'is_preview'               => false, 'sort' => 2, 'created_at' => $now, 'updated_at' => $now,
        ];

        // --- Module 1102: Prompt Engineering ---
        $lessons[] = [
            'id'       => $genId('1102', 1), 'module_id' => 'd0000000-0000-0000-0000-000000001102',
            'title'    => 'Teknik Zero-shot, One-shot, & Few-shot',
            'type'     => 'text',
            'content'  => '
                <article class="prose prose-slate max-w-none">
                    <h3>Seni Berbicara dengan AI</h3>
                    <p>Prompt Engineering adalah teknik memandu model untuk menghasilkan output yang diinginkan. Kualitas jawaban AI berbanding lurus dengan kualitas instruksi (Garbage In, Garbage Out).</p>

                    <h4>1. Zero-shot Prompting</h4>
                    <p>Meminta AI melakukan tugas tanpa memberikan contoh sama sekali. Ini mengandalkan pengetahuan bawaan model.</p>
                    <div class="bg-gray-100 p-4 rounded-md border border-gray-200">
                        <strong>User:</strong> "Klasifikasikan sentimen kalimat ini: Makanannya enak tapi pelayanannya lambat."<br>
                        <strong>AI:</strong> "Netral / Mixed."
                    </div>

                    <h4>2. Few-shot Prompting</h4>
                    <p>Memberikan beberapa contoh (demonstrasi) sebelum meminta AI menjawab. Ini sangat efektif untuk format output yang spesifik atau tugas yang sulit.</p>
                    <div class="bg-gray-100 p-4 rounded-md border border-gray-200">
                        <strong>User:</strong><br>
                        "Tugas: Ubah bahasa gaul menjadi formal."<br>
                        Contoh 1: "Gk bisa login nih gan" -> "Saya mengalami kendala saat masuk aplikasi."<br>
                        Contoh 2: "Kapan cairnya bos?" -> "Kapan dana akan dicairkan?"<br>
                        Input: "Lemot banget webnya woy"<br>
                        Output:<br>
                        <strong>AI:</strong> "Situs web ini berjalan sangat lambat."
                    </div>

                    <p>Riset menunjukkan bahwa Few-shot prompting meningkatkan akurasi model GPT-3 hingga 30% pada tugas-tugas penalaran kompleks dibandingkan Zero-shot.</p>
                </article>
            ',
            'duration' => 20, 'is_preview'               => false, 'sort' => 1, 'created_at' => $now, 'updated_at' => $now,
        ];

        // --- Module 1103: RAG ---
        $lessons[] = [
            'id'       => $genId('1103', 1), 'module_id' => 'd0000000-0000-0000-0000-000000001103',
            'title'    => 'Konsep RAG & Vector Database',
            'type'     => 'text',
            'content'  => '
                <article class="prose prose-slate max-w-none">
                    <h3>Mengatasi Halusinasi AI</h3>
                    <p>Kelemahan utama LLM adalah:</p>
                    <ul class="list-disc pl-5">
                        <li><strong>Cut-off Knowledge:</strong> Model tidak tahu kejadian setelah tanggal training.</li>
                        <li><strong>Private Data:</strong> Model tidak tahu data perusahaan Anda (PDF, Excel, Database internal).</li>
                        <li><strong>Hallucination:</strong> Model bisa mengarang fakta dengan sangat percaya diri.</li>
                    </ul>

                    <h4>Solusi: Retrieval Augmented Generation (RAG)</h4>
                    <p>RAG menggabungkan kemampuan pencarian (Retrieval) dengan kemampuan bahasa (Generation). Analoginya seperti memberikan buku "open book exam" kepada murid saat ujian.</p>

                    <h4>Alur Kerja RAG:</h4>
                    <ol class="list-decimal pl-5 space-y-2">
                        <li><strong>Ingestion:</strong> Dokumen (PDF/Docs) dipecah menjadi potongan kecil (Chunks).</li>
                        <li><strong>Embedding:</strong> Setiap chunk diubah menjadi vektor angka menggunakan model embedding (misal: <code>text-embedding-3-small</code>).</li>
                        <li><strong>Storage:</strong> Vektor disimpan di Vector Database (Pinecone, Milvus, pgvector).</li>
                        <li><strong>Retrieval:</strong> Saat user bertanya, pertanyaan diubah jadi vektor, lalu sistem mencari chunk yang vektornya paling mirip (Cosine Similarity).</li>
                        <li><strong>Generation:</strong> Chunk yang relevan ditempelkan ke prompt sebagai "Konteks", lalu dikirim ke GPT untuk dijawab.</li>
                    </ol>

                    <p>Dengan teknik ini, jawaban AI akan selalu berdasarkan data faktual yang Anda miliki, bukan hasil karangan.</p>
                </article>
            ',
            'duration' => 25, 'is_preview'               => false, 'sort' => 1, 'created_at' => $now, 'updated_at' => $now,
        ];

        // =========================================================================
        // COURSE 2: BACKEND CLEAN ARCHITECTURE
        // =========================================================================

        // --- Module 1201: Concept ---
        $lessons[] = [
            'id'       => $genId('1201', 1), 'module_id' => 'd0000000-0000-0000-0000-000000001201',
            'title'    => 'Filosofi Clean Architecture',
            'type'     => 'text',
            'content'  => '
                <article class="prose prose-slate max-w-none">
                    <h3>Software yang Tahan Banting</h3>
                    <p>Robert C. Martin (Uncle Bob) memperkenalkan Clean Architecture untuk memecahkan masalah klasik software development: <strong>Coupling yang tinggi</strong> dan <strong>Kode yang sulit dites</strong>.</p>

                    <h4>Masalah Spaghetti Code</h4>
                    <p>Pada arsitektur MVC tradisional (Model-View-Controller), seringkali logic bisnis bercampur dengan query database di Controller. Akibatnya:</p>
                    <ul>
                        <li>Jika ingin ganti database (misal MySQL ke MongoDB), kita harus bongkar semua kode.</li>
                        <li>Susah membuat Unit Test karena kode bergantung langsung pada database yang menyala.</li>
                    </ul>

                    <h4>The Dependency Rule</h4>
                    <p>Aturan suci Clean Arch: <strong>Arah ketergantungan hanya boleh masuk ke dalam.</strong></p>
                    <ul class="list-disc pl-5">
                        <li><strong>Layer Terdalam (Entities/Domain):</strong> Berisi aturan bisnis murni. Tidak boleh tahu ada database, tidak boleh ada tag JSON, tidak boleh import library HTTP.</li>
                        <li><strong>Layer Tengah (Usecase):</strong> Berisi alur aplikasi. Mengorkestrasi data dari repository ke domain.</li>
                        <li><strong>Layer Terluar (Adapters/Delivery):</strong> Berisi detail teknis. Handler HTTP, Driver SQL, Config.</li>
                    </ul>
                    <p>Dengan struktur ini, "Aplikasi" (Domain) tidak peduli apakah dia dijalankan lewat Web API, CLI, atau gRPC. Dia tetap murni.</p>
                </article>
            ',
            'duration' => 15, 'is_preview'               => true, 'sort' => 1, 'created_at' => $now, 'updated_at' => $now,
        ];

        // --- Module 1202: Domain ---
        $lessons[] = [
            'id'       => $genId('1202', 1), 'module_id' => 'd0000000-0000-0000-0000-000000001202',
            'title'    => 'Mendesain Entities & Repository Interface',
            'type'     => 'text',
            'content'  => '
                <article class="prose prose-slate max-w-none">
                    <h3>Jantung Aplikasi: Domain Layer</h3>
                    <p>Kita mulai coding dari tengah, bukan dari database. Ini memaksa kita fokus pada bisnis, bukan teknologi.</p>

                    <h4>1. Struct Entity</h4>
                    <p>Perhatikan bahwa struct ini polos. Tidak ada tag `json` atau `gorm`. Ini murni Go struct.</p>
                    <pre class="bg-slate-900 text-slate-100 p-4 rounded-lg my-4"><code>package domain

import "time"

type User struct {
    ID        int64
    Name      string
    Email     string
    Password  string
    CreatedAt time.Time
    UpdatedAt time.Time
}

// Method bisnis bisa ditaruh di sini
func (u *User) IsActive() bool {
    return u.ID > 0
}</code></pre>

                    <h4>2. Repository Interface</h4>
                    <p>Di layer domain, kita hanya mendefinisikan "Kontrak". Kita butuh alat untuk menyimpan user, tapi kita tidak peduli bagaimana caranya (mau pakai SQL, File, atau Memory).</p>
                    <pre class="bg-slate-900 text-slate-100 p-4 rounded-lg my-4"><code>package domain

import "context"

// Kontrak: Siapapun yang mau jadi Repository User harus bisa melakukan ini
type UserRepository interface {
    Fetch(ctx context.Context, cursor string, num int64) ([]User, error)
    GetByID(ctx context.Context, id int64) (User, error)
    GetByEmail(ctx context.Context, email string) (User, error)
    Store(ctx context.Context, u *User) error
    Delete(ctx context.Context, id int64) error
}</code></pre>
                    <p>Interface inilah yang memungkinkan kita melakukan <strong>Dependency Injection</strong> nanti. Di Usecase, kita akan memegang `UserRepository`, bukan `MySqlUserRepository`.</p>
                </article>
            ',
            'duration' => 20, 'is_preview'               => false, 'sort' => 1, 'created_at' => $now, 'updated_at' => $now,
        ];

        // --- Module 1204: Infrastructure ---
        $lessons[] = [
            'id'       => $genId('1204', 1), 'module_id' => 'd0000000-0000-0000-0000-000000001204',
            'title'    => 'Implementasi Delivery dengan Gin Gonic',
            'type'     => 'text',
            'content'  => '
                <article class="prose prose-slate max-w-none">
                    <h3>Delivery Layer: Gerbang Dunia Luar</h3>
                    <p>Layer ini bertugas "berbicara" dengan klien (Frontend/Mobile App). Tugas utamanya:</p>
                    <ol>
                        <li>Parsing Input (JSON Body, Query Param).</li>
                        <li>Validasi Input dasar (Required fields).</li>
                        <li>Memanggil Usecase.</li>
                        <li>Mapping hasil Usecase ke format JSON Response.</li>
                        <li>Handling HTTP Status Code (200, 400, 500).</li>
                    </ol>

                    <h4>Contoh Handler</h4>
                    <pre class="bg-slate-900 text-slate-100 p-4 rounded-lg my-4"><code>type UserHandler struct {
    UserUsecase domain.UserUsecase
}

func (h *UserHandler) Register(c *gin.Context) {
    var req registerRequest
    if err := c.ShouldBindJSON(&req); err != nil {
        c.JSON(400, gin.H{"error": err.Error()})
        return
    }

    user := domain.User{
        Name:  req.Name,
        Email: req.Email,
    }

    // Panggil Usecase (Bisnis Logic)
    if err := h.UserUsecase.Store(c, &user); err != nil {
        c.JSON(500, gin.H{"error": "Internal Server Error"})
        return
    }

    c.JSON(201, gin.H{"message": "Success", "data": user})
}</code></pre>
                    <p>Perhatikan bahwa Handler tidak melakukan query SQL. Dia hanya mendelegasikan tugas ke Usecase.</p>
                </article>
            ',
            'duration' => 15, 'is_preview'               => false, 'sort' => 1, 'created_at' => $now, 'updated_at' => $now,
        ];

        // =========================================================================
        // COURSE 3: DEVOPS MASTERCLASS
        // =========================================================================

        // --- Module 1301: Docker ---
        $lessons[] = [
            'id'       => $genId('1301', 1), 'module_id' => 'd0000000-0000-0000-0000-000000001301',
            'title'    => 'Deep Dive: Docker Internals',
            'type'     => 'text',
            'content'  => '
                <article class="prose prose-slate max-w-none">
                    <h3>Bagaimana Docker Sebenarnya Bekerja?</h3>
                    <p>Banyak developer menggunakan Docker, tapi sedikit yang paham apa yang terjadi di bawah kap mesin. Docker sebenarnya bukanlah teknologi "baru", melainkan pembungkus pintar (wrapper) untuk fitur kernel Linux.</p>

                    <h4>1. Namespaces (Isolasi)</h4>
                    <p>Bagaimana Docker membuat container A tidak bisa melihat file container B? Jawabannya adalah <strong>Linux Namespaces</strong>.</p>
                    <ul>
                        <li><strong>PID Namespace:</strong> Container memiliki ID proses sendiri. PID 1 di container berbeda dengan PID 1 di host.</li>
                        <li><strong>MNT Namespace:</strong> Container memiliki sistem file root (/) sendiri.</li>
                        <li><strong>NET Namespace:</strong> Container memiliki kartu jaringan virtual (eth0) dan IP sendiri.</li>
                    </ul>

                    <h4>2. Cgroups (Limitasi)</h4>
                    <p>Bagaimana cara mencegah satu container memakan 100% RAM server? Jawabannya adalah <strong>Control Groups (cgroups)</strong>. Fitur kernel ini membatasi resource CPU dan Memory yang bisa digunakan oleh sebuah proses.</p>

                    <h4>3. Union File System (Layering)</h4>
                    <p>Ini adalah alasan kenapa Docker Image sangat efisien. Image dibangun seperti kue lapis. Jika Anda punya 10 container Node.js, layer "OS Ubuntu"-nya hanya disimpan sekali di harddisk (Read Only), dan disharing ke semua container. Container hanya membuat layer tipis "Read-Write" di atasnya.</p>
                </article>
            ',
            'duration' => 20, 'is_preview'               => true, 'sort' => 1, 'created_at' => $now, 'updated_at' => $now,
        ];

        $lessons[] = [
            'id'       => $genId('1301', 2), 'module_id' => 'd0000000-0000-0000-0000-000000001301',
            'title'    => 'Optimasi Dockerfile dengan Multi-stage Build',
            'type'     => 'text',
            'content'  => '
                <article class="prose prose-slate max-w-none">
                    <h3>Masalah: Image Size Bengkak</h3>
                    <p>Saat kita membuild aplikasi Go atau Node, kita butuh compiler (GCC, Go Toolchain, Node modules dev dependencies). Tapi saat aplikasi dijalankan di production, kita tidak butuh itu semua. Kita hanya butuh binary hasil compile.</p>
                    <p>Jika kita memasukkan compiler ke production image, ukurannya bisa mencapai 800MB+. Ini boros bandwidth dan storage, serta tidak aman (hacker bisa compile malware di server kita).</p>

                    <h4>Solusi: Multi-stage Build</h4>
                    <p>Kita membagi Dockerfile menjadi beberapa fase.</p>
                    <pre class="bg-slate-900 text-slate-100 p-4 rounded-lg my-4"><code># STAGE 1: Builder
# Kita pakai image besar yang lengkap isinya
FROM golang:1.21-alpine AS builder
WORKDIR /app
COPY . .
# Build binary menjadi file tunggal
RUN go build -o myapp main.go

# STAGE 2: Runner
# Kita pakai image super kecil (Alpine: 5MB)
FROM alpine:latest
WORKDIR /root/
# Kita HANYA mengcopy file binary dari Stage 1
COPY --from=builder /app/myapp .

# Jalankan
CMD ["./myapp"]</code></pre>

                    <p><strong>Hasil:</strong> Image size turun drastis dari 800MB menjadi hanya 15MB. Deployment lebih cepat 50x lipat.</p>
                </article>
            ',
            'duration' => 15, 'is_preview'               => false, 'sort' => 2, 'created_at' => $now, 'updated_at' => $now,
        ];

        // --- Module 1302: CI/CD ---
        $lessons[] = [
            'id'       => $genId('1302', 1), 'module_id' => 'd0000000-0000-0000-0000-000000001302',
            'title'    => 'Anatomy of GitHub Actions Workflow',
            'type'     => 'text',
            'content'  => '
                <article class="prose prose-slate max-w-none">
                    <h3>Otomatisasi Pipeline dari Nol</h3>
                    <p>GitHub Actions menggunakan format YAML yang ditaruh di folder <code>.github/workflows</code>. Ada 3 komponen utama:</p>

                    <h4>1. Event (Triggers)</h4>
                    <p>Kapan pipeline ini jalan? Biasanya saat ada <code>push</code> ke branch <code>main</code> atau saat ada <code>pull_request</code>.</p>
                    <pre class="bg-slate-900 text-slate-100 p-4 rounded-lg"><code>on:
  push:
    branches: [ "main" ]</code></pre>

                    <h4>2. Jobs</h4>
                    <p>Kumpulan tugas yang berjalan. Kita bisa punya job "Test", job "Build", dan job "Deploy". Jobs secara default jalan paralel, tapi bisa dibuat berurutan (needs).</p>

                    <h4>3. Steps (Langkah)</h4>
                    <p>Instruksi detail di dalam Job.</p>
                    <pre class="bg-slate-900 text-slate-100 p-4 rounded-lg my-4"><code>jobs:
  build-and-test:
    runs-on: ubuntu-latest
    steps:
      - uses: actions/checkout@v3  # 1. Ambil kodingan

      - name: Set up Go
        uses: actions/setup-go@v4  # 2. Install Go di server runner
        with:
          go-version: 1.21

      - name: Run Test             # 3. Jalankan Unit Test
        run: go test ./... -v</code></pre>

                    <p>Jika "Run Test" gagal (ada bug), maka pipeline akan berhenti dan merah. GitHub akan mengirim email notifikasi. Anda tidak boleh merge code yang merah.</p>
                </article>
            ',
            'duration' => 20, 'is_preview'               => false, 'sort' => 1, 'created_at' => $now, 'updated_at' => $now,
        ];

        DB::table('lessons')->insert($lessons);
    }
}
