import { useState, useEffect} from 'react';
import axios from 'axios'
import Navbar from '@/components/navigation/navbar';
import { Card, CardContent, CardDescription, CardFooter, CardHeader, CardTitle } from "@/components/ui/card"
import { Button } from "@/components/ui/button";

interface Industri{
    id : number;
    nama: string;
    bidang_usaha: string;
    alamat: string;
    kontak: string;
    logo?: string;
    email?: string;
    website?: string;
}
const Industri = () => {

    const [data, setData] = useState<Industri[]>([]);

        useEffect(() => {
            axios.get(`/api/industri`)
            .then(response => {
                setData(response.data);
            })
            .catch(error => {
                console.error('Error jir:', error);
            });
        }, []);

    return (
        <div className="relative w-full bg-[#E8F2F1] ">
        <Navbar/>
            <div className="p-4 pt-25 md:pl-68 min-h-screen ">
                <div className="bg-[#106E69] p-4 rounded-2xl w-fit max-w-2xl">
                    <h1 className="font-semibold">SMKN 2 Depok</h1>
                    <h1 className="text-2xl font-extrabold">Daftar Industri</h1>
                </div>

            <div className='mt-4 grid grid-cols-[repeat(auto-fit,minmax(400px,1fr))] w-full gap-4'>
            {data.length === 0 ? (
                <div className='grid grid-cols-[repeat(auto-fit,minmax(400px,1fr))] w-full gap-4'>
                    {[...Array(9)].map((_, idx) => (
                        <Card key={idx} className="max-w-md overflow-hidden bg-white rounded-2xl shadow-lg animate-pulse">
                            <div className="flex w-full h-full items-center aspect-square justify-center">
                                <div className="bg-gray-200 rounded-lg w-30 h-30" />
                            </div>
                            <div>
                                <CardHeader className="pb-2 w-60">
                                    <div className="h-4 bg-gray-200 rounded w-32 mb-2" />
                                    <div className="h-3 bg-gray-200 rounded w-24" />
                                </CardHeader>
                                <CardContent>
                                    <div className="h-3 bg-gray-200 rounded w-full mb-1" />
                                    <div className="h-3 bg-gray-200 rounded w-3/4" />
                                </CardContent>
                                <CardFooter className="flex justify-end">
                                    <div className="mt-3 h-6 w-16 bg-gray-200 rounded" />
                                </CardFooter>
                            </div>
                        </Card>
                    ))}
                </div>
            ) : (

            data.map((industri) => (
                <Card key={industri.id} className="max-w-md overflow-hidden bg-white rounded-2xl shadow-lg transition-transform hover:scale-101 will-change-transform">
                    <div className="flex w-full h-full items-center aspect-square justify-center ">
                        <img
                            src={industri.logo || `https://img.freepik.com/premium-vector/building-logo-vector-illustration-designreal-estate-logo-template-logo-symbol-icon_9999-19683.jpg`}
                            className="object-cover rounded-lg shadow w-30 h-30 border border-gray-200"
                            alt="CV Karya Hidup Sentosa Logo"
                            draggable="false"
                        />
                    </div>
                    <div className='p-2'>
                        <CardHeader className="pb-2 w-60">
                            <CardTitle className="text-md font-bold text-[#106E69]">{industri.nama}</CardTitle>
                            <CardDescription className="text-sm text-gray-500">{industri.bidang_usaha}</CardDescription>
                        </CardHeader>
                        <CardContent className="text-xs text-gray-700 line-clamp-3">
                            {industri.alamat}
                        </CardContent>
                        <CardFooter className="flex justify-end">
                            <Button variant="link" size="icon" className=" transition-colors">
                                Detail
                            </Button>
                        </CardFooter>
                    </div>
                </Card>
                ))
            )}
        </div>


            </div>
        </div>
    );
}

export default Industri;