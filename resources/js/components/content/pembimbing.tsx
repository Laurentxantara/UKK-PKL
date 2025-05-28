import React from 'react';
import Navbar from '@/components/navigation/navbar';
import { useEffect, useState } from 'react';
import axios from 'axios';
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from "@/components/ui/table";
import { Pagination, PaginationContent, PaginationEllipsis, PaginationItem, PaginationLink, PaginationNext, PaginationPrevious } from "@/components/ui/pagination"


interface Guru {
    id: number;
    nama: string;
    nip: string;
    email: string;
    gender: string;
    avatar?: string;
}

const Pembimbing = () => {
    const [guru, setGuru] = useState<Guru[]>([]);
    const [searchQuery, setSearchQuery] = useState('');

    useEffect(() => {
        axios.get(`/api/guru-pembimbing`)
            .then(response => {
                setGuru(response.data);
            })
            .catch(error => {
                console.error('Error:', error);
            })
    }, []);

    const filteredGuru = guru.filter(g =>
        g.nama.toLowerCase().includes(searchQuery.toLowerCase()) ||
        g.nip.toLowerCase().includes(searchQuery.toLowerCase()) ||
        g.email.toLowerCase().includes(searchQuery.toLowerCase())
    );

    console.log(filteredGuru);
    
    return (
        <div className="relative w-full bg-[#E8F2F1]">
            <Navbar/>
            <div className="p-4 pt-25 md:pl-68 min-h-screen">
                <div className="bg-[#106E69] p-4 rounded-2xl w-fit max-w-2xl">
                    <h1 className="font-semibold">SMKN 2 Depok</h1>
                    <h1 className="text-2xl font-extrabold">Daftar Pembimbing</h1>
                </div>

                {/* Search Input */}
                <div className="my-4">
                    <input
                        type="text"
                        placeholder="Cari berdasarkan nama, NIP, atau email..."
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
                                <TableHead>NIP</TableHead>
                                <TableHead>Gender</TableHead>
                                <TableHead>Email</TableHead>
                            </TableRow>
                        </TableHeader>
                        <TableBody>
                            {filteredGuru.length === 0 ? (
                                <TableRow>
                                    <TableCell colSpan={5} className="text-center font-semibold text-gray-300">
                                        {guru.length === 0 ? "Loading..." : "Tidak ada pembimbing yang ditemukan"}
                                    </TableCell>
                                </TableRow>
                            ) : (
                                filteredGuru.map((g) => (
                                    <TableRow key={g.id}>
                                        <TableCell>
                                            <img 
                                                src={g.avatar || `https://thumbs.dreamstime.com/b/default-avatar-profile-icon-social-media-user-vector-image-icon-default-avatar-profile-icon-social-media-user-vector-image-209162840.jpg`}
                                                alt={g.nama}
                                                className="w-10 h-10 rounded-full object-cover"
                                                draggable="false"
                                            />
                                        </TableCell>
                                        <TableCell>{g.nama}</TableCell>
                                        <TableCell>{g.nip}</TableCell>
                                        <TableCell>{g.gender}</TableCell>
                                        <TableCell>{g.email}</TableCell>
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

export default Pembimbing;
