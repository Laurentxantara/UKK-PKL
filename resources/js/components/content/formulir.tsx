import { useEffect, useState } from 'react';
import axios from 'axios';
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from "@/components/ui/table";
import Navbar from '@/components/navigation/navbar';
import InsertFormulir from '@/components/form/formulir';

interface Formulir {
    id: number;
    siswa: {
            id: number;
            nama: string;
        };
    guru: {
            id: number;
            nama: string;
        };
    industri: {
            id: number;
            nama: string;
        };
    tanggal_mulai: string;
    tanggal_selesai: string;
    durasi: string;


}

const Formulir = () => {
  const [data, setData] = useState<Formulir[]>([]);

  const fetchData = () => {
    axios.get('/api/formulir')
        .then(response => {
            setData(response.data);
        })
        .catch(error => {
            console.error('Error jir:', error);
        });
    };

    useEffect(() => {
        fetchData();
    }, []);

    return (
        <div className="relative w-full bg-[#E8F2F1]">
        <Navbar/>
            <div className="p-4 pt-25 md:pl-68 min-h-screen ">
                <div className='flex relative w-full'>
                    <div className="bg-[#106E69] p-4 rounded-2xl w-fit max-w-2xl">
                        <h1 className="font-semibold">SMKN 2 Depok</h1>
                        <h1 className="text-2xl font-extrabold">Formulir PKL</h1>
                    </div>
                    <InsertFormulir onSuccess={fetchData} />
                </div>
                 <div className='mt-4'>
                    <Table className="rounded-2xl bg-white">
                    <TableHeader>
                        <TableRow className='hover:bg-none'>
                        <TableHead>Nama Siswa</TableHead>
                        <TableHead>Guru Pembimbing</TableHead>
                        <TableHead>Industri</TableHead>
                        <TableHead>Tanggal Mulai</TableHead>
                        <TableHead>Tanggal Selesai</TableHead>
                        <TableHead>Durasi</TableHead>
                        </TableRow>
                    </TableHeader>
                    <TableBody>
                        {data.length === 0 ? (
                        <TableRow>
                            <TableCell colSpan={6} className="text-center font-semibold text-gray-300">Loading...</TableCell>
                        </TableRow>
                        ) : (
                        data.map((formulir) => (
                            <TableRow key={formulir.id}>
                            <TableCell>{formulir.siswa.nama}</TableCell>
                            <TableCell>{formulir.guru.nama}</TableCell>
                            <TableCell>{formulir.industri.nama}</TableCell>
                            <TableCell>{formulir.tanggal_mulai}</TableCell>
                            <TableCell>{formulir.tanggal_selesai}</TableCell>
                            <TableCell>{formulir.durasi}</TableCell>
                            </TableRow>
                        ))
                        )}
                    </TableBody>
                    </Table>
                </div>
            </div>
        </div>
    );
}
export default Formulir;