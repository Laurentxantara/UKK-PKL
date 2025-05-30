import { Dialog, DialogTitle, DialogContent, DialogTrigger } from "@/components/ui/dialog"
import { useEffect, useState } from 'react';
import { usePage } from '@inertiajs/react';
import axios from 'axios';

interface InsertFormulirProps {
  onSuccess: () => void;
}

type AuthProps = {
  user: {
    id: number;
    name: string;
    email: string;
    roles: string[];
    permissions: string[];
  };
  
};


interface Siswa {
    id: number;
    nama: string;
}

interface Guru {
    id: number;
    nama: string;
}

interface Industri {
    id: number;
    nama: string;
}

const InsertFormulir = ({ onSuccess }: InsertFormulirProps) => {
    const [dateError, setDateError] = useState<string>('');
    const [errors, setErrors] = useState<{[key: string]: string[]}>({});
    const [open, setOpen] = useState(false);
    const [loading, setLoading] = useState(false);
    
    const pageProps = usePage().props as Record<string, unknown>;
    const auth = pageProps.auth as AuthProps;
    const isAdmin = auth?.user?.roles?.includes('admin');

// console.log(auth);

    const handleOpenChange = (open: boolean) => {
        setOpen(open);
        if (!open) {
            setErrors({});
            setDateError('');
        }
    };

    interface FormData {
        id_siswa: number | '';
        id_guru: number | '';
        id_industri: number | '';
        tanggal_mulai: string;
        tanggal_selesai: string;
    }

    const [formData, setFormData] = useState<FormData>({
        id_siswa: '',
        id_guru: '',
        id_industri: '',
        tanggal_mulai: '',
        tanggal_selesai: ''
    });

    const validateDates = () => {
        if (formData.tanggal_mulai && formData.tanggal_selesai) {
            const startDate = new Date(formData.tanggal_mulai);
            const endDate = new Date(formData.tanggal_selesai);
            
            if (endDate < startDate) {
                setDateError('Tanggal selesai tidak boleh lebih awal dari tanggal mulai');
                return false;
            }
        }
        setDateError('');
        return true;
    };

    const handleEndDateChange = (e: React.ChangeEvent<HTMLInputElement>) => {
        const newEndDate = e.target.value;
        setFormData({...formData, tanggal_selesai: newEndDate});
        
        if (formData.tanggal_mulai) {
            const startDate = new Date(formData.tanggal_mulai);
            const endDate = new Date(newEndDate);
            
            if (endDate < startDate) {
                setDateError('Tanggal selesai tidak boleh lebih awal dari tanggal mulai');
            } else {
                setDateError('');
            }
        }
    };

    const handleSubmit = async (e: React.FormEvent) => {
        e.preventDefault();
        if (!validateDates()) {
            return;
        }
        
        try {
            setLoading(true);
            setErrors({});
            await axios.post('/api/formulir', formData);
            const emptyForm: FormData = {
                id_siswa: '',
                id_guru: '',
                id_industri: '',
                tanggal_mulai: '',
                tanggal_selesai: ''
            };
            setFormData(emptyForm);
            setDateError('');
            setOpen(false);
            onSuccess();
        } catch (error) {
            if (axios.isAxiosError(error) && error.response?.data?.errors) {
                setErrors(error.response.data.errors);
            }
            console.error('Error submitting form:', error);
        } finally {
            setLoading(false);
        }
    };

    useEffect(() => {
        axios.get('/api/siswa').then(response => setSiswaList(response.data.siswa));
        axios.get('/api/guru-pembimbing').then(response => setGuruList(response.data));
        axios.get('/api/industri').then(response => setIndustriList(response.data));
    }, []);

    const [siswaList, setSiswaList] = useState<Siswa[]>([]);
    const [guruList, setGuruList] = useState<Guru[]>([]);
    const [industriList, setIndustriList] = useState<Industri[]>([]);


    return (
        <>
        <Dialog open={open} onOpenChange={handleOpenChange}>
            {/* { isAdmin &&   */}
            <DialogTrigger className="absolute right-0 bottom-0 bg-[#106E69] p-2 text-sm font-semibold hover:bg-[#0d5955] cursor-pointer rounded-md ">+ Tambah Laporan</DialogTrigger>
            {/* } */}
            <DialogContent className="rounded-4xl">
                <DialogTitle>
                <div className="mb-4">
                    <h2 className="text-xl text-black font-bold">Tambah Data PKL</h2>
                    <p className="text-black">Masukkan Data Diri Anda</p>
                </div>
                </DialogTitle>
                <form onSubmit={handleSubmit}>
                    <div className="grid grid-cols-1 gap-4">
                        <div>
                            <label htmlFor="" className="text-black"> Nama Siswa</label>
                            <select 
                                required
                                value={formData.id_siswa}
                                onChange={e => setFormData({...formData, id_siswa: Number(e.target.value)})}
                                className={`border text-black border-[#106E69] rounded p-2 w-full ${errors.id_siswa ? 'border-red-500' : ''}`}
                                disabled={loading}
                            >
                                <option value="">Pilih Siswa</option>
                                {siswaList.map(siswa => (
                                    <option key={siswa.id} value={siswa.id}>{siswa.nama}</option>
                                ))}
                            </select>
                            {errors.id_siswa && (
                                <p className="text-red-500 text-sm">{errors.id_siswa[0]}</p>
                            )}
                        </div>
                        
                        <div>
                            <label htmlFor="" className="text-black">Guru Pembimbing</label>
                            <select 
                                required
                                value={formData.id_guru}
                                onChange={e => setFormData({...formData, id_guru: Number(e.target.value)})}
                                className={`border text-black border-[#106E69] rounded p-2 w-full ${errors.id_guru ? 'border-red-500' : ''}`}
                                disabled={loading}
                            >
                                <option value="">Pilih Guru</option>
                                {guruList.map(guru => (
                                    <option key={guru.id} value={guru.id}>{guru.nama}</option>
                                ))}
                            </select>
                            {errors.id_guru && (
                                <p className="text-red-500 text-sm">{errors.id_guru[0]}</p>
                            )}
                        </div>

                        <div>
                            <label htmlFor="" className="text-black">Industri</label>
                            <select 
                                required
                                value={formData.id_industri}
                                onChange={e => setFormData({...formData, id_industri: Number(e.target.value)})}
                                className={`border text-black border-[#106E69] rounded p-2 w-full ${errors.id_industri ? 'border-red-500' : ''}`}
                                disabled={loading}
                            >
                                <option value="">Pilih Industri</option>
                                {industriList.map(industri => (
                                    <option key={industri.id} value={industri.id}>{industri.nama}</option>
                                ))}
                            </select>
                            {errors.id_industri && (
                                <p className="text-red-500 text-sm">{errors.id_industri[0]}</p>
                            )}
                        </div>
                        
                        <div className="grid grid-cols-2 gap-4">
                            <div>
                            <label htmlFor="" className="text-black">Tanggal Mulai</label>
                                <input
                                    required
                                    type="date"
                                    value={formData.tanggal_mulai}
                                    onChange={e => setFormData({...formData, tanggal_mulai: e.target.value})}
                                    className={`border text-black border-[#106E69] rounded p-2 w-full ${errors.tanggal_mulai ? 'border-red-500' : ''}`}
                                    disabled={loading}
                                />
                                {errors.tanggal_mulai && (
                                    <p className="text-red-500 text-sm">{errors.tanggal_mulai[0]}</p>
                                )}
                            </div>

                            <div>
                            <label htmlFor="" className="text-black">Tanggal Selesai</label>
                                <input
                                    required
                                    type="date"
                                    value={formData.tanggal_selesai}
                                    onChange={handleEndDateChange}
                                    className={`border text-black border-[#106E69] rounded p-2 w-full ${errors.tanggal_selesai || dateError ? 'border-red-500' : ''}`}
                                    disabled={loading}
                                />
                                {errors.tanggal_selesai && (
                                    <p className="text-red-500 text-sm">{errors.tanggal_selesai[0]}</p>
                                )}
                                {dateError && (
                                    <p className="text-red-500 text-sm">{dateError}</p>
                                )}
                            </div>
                        </div>

                        <button 
                            type="submit"
                            disabled={loading} 
                            className="bg-[#106E69] text-white px-4 py-2 font-semibold rounded-md cursor-pointer disabled:opacity-50 hover:bg-[#0d5955]"
                        >
                            {loading ? 'Menyimpan...' : 'Simpan'}
                        </button>
                    </div>
                </form>
            </DialogContent>
        </Dialog>
        </>
    );
}

export default InsertFormulir;
