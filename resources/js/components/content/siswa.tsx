import React from 'react';
import Navbar from '@/components/navigation/navbar';
import { useEffect, useState } from 'react';
import axios from 'axios';
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from "@/components/ui/table";
import { Pagination, PaginationContent, PaginationEllipsis, PaginationItem, PaginationLink, PaginationNext, PaginationPrevious } from "@/components/ui/pagination"
import * as Icons from 'lucide-react';

interface Siswa {
    id: number;
    nama: string;
    nis: string;
    email: string;
    gender: string;
    status_pkl: string;
    avatar?: string;
}

const Siswa = () => {
    const [allsiswa, setAllSiswa] = useState<Siswa[]>([]);
    const [searchQuery, setSearchQuery] = useState('');

    const getStatusIcon = (status: string) => {
        switch (status.toLowerCase()) {
            case 'diterima':
                return <Icons.CheckCircle2 className="w-5 h-5 text-green-500 justify-center items-center" />;
            case 'kosong':
                return <Icons.CircleMinus className="w-5 h-5 text-gray-500" />;
        }
    };

    useEffect(() => {
        axios.get(`/api/siswa`)
            .then(response => {
                setAllSiswa(response.data.allsiswa);
            })
            .catch(error => {
                console.error('Error:', error);
            })
    }, []);

    const filteredSiswa = allsiswa.filter(siswa =>
        siswa.nama.toLowerCase().includes(searchQuery.toLowerCase()) ||
        siswa.nis.toLowerCase().includes(searchQuery.toLowerCase()) ||
        siswa.email.toLowerCase().includes(searchQuery.toLowerCase())
    );
    
    return (
        <div className="relative w-full bg-[#E8F2F1]">
            <Navbar/>
            <div className="p-4 pt-25 md:pl-68 min-h-screen ">
                <div className="bg-[#106E69] p-4 rounded-2xl w-fit max-w-2xl">
                    <h1 className="font-semibold">SMKN 2 Depok</h1>
                    <h1 className="text-2xl font-extrabold">Daftar Siswa</h1>
                </div>

                {/* Search Input */}
                <div className="my-4">
                    <input
                        type="text"
                        placeholder="Cari berdasarkan nama, NIS, atau email..."
                        className="p-2 border rounded-lg w-full text-black max-w-sm bg-white"
                        value={searchQuery}
                        onChange={(e) => setSearchQuery(e.target.value)}
                    />
                </div>

                <div className='mt-4'>
                    <Table className="rounded-2xl bg-white">
                        <TableHeader>
                            <TableRow className='hover:bg-none'>
                                <TableHead></TableHead>
                                <TableHead>Nama</TableHead>
                                <TableHead>NIS</TableHead>
                                <TableHead>Gender</TableHead>
                                <TableHead>Email</TableHead>
                                <TableHead className='text-center'>Status PKL</TableHead>
                            </TableRow>
                        </TableHeader>
                        <TableBody>
                            {filteredSiswa.length === 0 ? (
                                <TableRow>
                                    <TableCell colSpan={6} className="text-center font-semibold text-gray-300">
                                        {allsiswa.length === 0 ? "Loading..." : "Tidak ada siswa yang ditemukan"}
                                    </TableCell>
                                </TableRow>
                            ) : (
                                filteredSiswa.map((siswa) => (
                                    <TableRow key={siswa.id}>
                                        <TableCell>
                                            <img 
                                                src={siswa.avatar || `https://thumbs.dreamstime.com/b/default-avatar-profile-icon-social-media-user-vector-image-icon-default-avatar-profile-icon-social-media-user-vector-image-209162840.jpg`}
                                                alt={siswa.nama}
                                                className="w-10 h-10 rounded-full object-cover"
                                                draggable="false"
                                            />
                                        </TableCell>
                                        <TableCell>{siswa.nama}</TableCell>
                                        <TableCell>{siswa.nis}</TableCell>
                                        <TableCell>{siswa.gender}</TableCell>
                                        <TableCell>{siswa.email}</TableCell>
                                        <TableCell>
                                            <div className="flex flex-col items-center justify-center" title={siswa.status_pkl}>
                                                <div className='flex flex-col items-center'>
                                                    {getStatusIcon(siswa.status_pkl)}
                                                    <span className="text-xs text-gray-600">{siswa.status_pkl}</span>
                                                </div>
                                            </div>
                                        </TableCell>
                                    </TableRow>
                                ))
                            )} 
                        </TableBody>
                    </Table>
                    <Pagination>
                    <PaginationContent>
                        <PaginationItem>
                        <PaginationPrevious href="#" />
                        </PaginationItem>
                        <PaginationItem>
                        <PaginationLink href="#">1</PaginationLink>
                        </PaginationItem>
                        <PaginationItem>
                        <PaginationEllipsis />
                        </PaginationItem>
                        <PaginationItem>
                        <PaginationNext href="#" />
                        </PaginationItem>
                    </PaginationContent>
                    </Pagination>
                </div>
            </div>
        </div>
    );
};

export default Siswa;
