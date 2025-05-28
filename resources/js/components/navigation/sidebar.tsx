import { Link, router, usePage } from "@inertiajs/react";
import * as Icons from "lucide-react";
import { useState, useEffect } from "react";
import { Separator } from "@/components/ui/separator";
import { Sheet, SheetContent, SheetHeader, SheetTitle, SheetTrigger } from "@/components/ui/sheet"
import { Accordion, AccordionContent, AccordionItem, AccordionTrigger } from "@/components/ui/accordion";
import { Badge } from "../ui/badge";
import { Button } from "@headlessui/react";
import axios from "axios";

interface Counts {
    total_guru: number;
    total_siswa: number;
}

// const handleLogout = () => {
//     router.post("/logout");
// };

const Sidebar = () => {

    const { auth } = usePage().props;
    const userRole = auth.role;


      const [counts, setCounts] = useState<Counts>({
        total_guru: 0,
        total_siswa: 0
    });

    useEffect(() => {
        axios.get('/api/counts')
            .then(response => {
                setCounts(response.data);
            })
            .catch(error => {
                console.error('Error fetching counts:', error);
            });
    }, []);

    const [accordionValue, setAccordionValue] = useState<string>(() => {
        if (typeof window !== 'undefined') {
            return localStorage.getItem('sidebarAccordion') || '';
        }
        return '';
    });

    const handleAccordionChange = (value: string) => {
        setAccordionValue(value);
        localStorage.setItem('sidebarAccordion', value);
    };

    return (
        <aside className="hidden md:block  h-full z-50 fixed bg-white p-4 shadow-lg">
            <div>
            <Link href="/dashboard">
                <img src="/tes.png" className="w-55" alt="" />
            </Link>
            </div>
            <Separator className="my-2"/>            
            <h2 className="text-[#6E6E6E] font-semibold">Menu</h2>
                <ul className="text-black space-y-3">
                    <li>
                        <Link className="flex items-center group space-x-2 p-2 hover:bg-[#106E69] hover:text-white transition-all rounded-md" 
                            href="/dashboard">
                            <div className="bg-gray-200 p-1 rounded-md group-hover:bg-white">
                                <Icons.Home strokeWidth={1.5} className="text-gray-500 group-hover:text-[#106E69] transition-colors" /> 
                            </div>
                            <span className="font-semibold text-sm group-hover:text-white transition-colors">Dashboard</span> 
                        </Link>
                    </li>
                    <li>
                        <Accordion 
                            type="single" 
                            collapsible
                            value={accordionValue}
                            onValueChange={handleAccordionChange}
                        >
                        <AccordionItem value="item-1">
                            <AccordionTrigger className="group hover:bg-[#106E69] transition-all">
                                <div className="flex items-center space-x-2 p-2">
                                    <div className="bg-gray-200 p-1 rounded-md group-hover:bg-white">
                                        <Icons.User strokeWidth={1.5} className="text-gray-500 group-hover:text-[#106E69] transition-colors" /> 
                                    </div>
                                    <span className="font-semibold text-sm group-hover:text-white transition-colors">Guru & Siswa</span> 
                                </div>
                            </AccordionTrigger>
                            <AccordionContent>
                                <Link className="flex items-center justify-between mt-2 space-x-2 p-2 ml-4 hover:bg-gray-200 hover:text-black transition-all rounded-md" 
                                    href="/guru-pembimbing">
                                    <div className="w-full flex items-center space-x-2">
                                        <Icons.Presentation strokeWidth={1.5}/> 
                                        <span className="font-normal text-sm">Pembimbing</span> 
                                    </div>
                                    <Badge variant="jumlah">{counts.total_guru}</Badge>
                                </Link>
                                <Link className="flex items-center mt-2 space-x-2 p-2 ml-4 hover:bg-gray-200 hover:text-black transition-all rounded-md" 
                                    href="/siswa">
                                    <div className="w-full flex items-center space-x-2">
                                        <Icons.GraduationCap strokeWidth={1.5}/> 
                                        <span className="font-normal text-sm">Siswa</span>  
                                    </div>
                                    <Badge variant="jumlah">{counts.total_siswa}</Badge>
                                </Link>
                            </AccordionContent>
                        </AccordionItem>
                        </Accordion>

                    </li>
                    <li>
                        <Link className="flex items-center group space-x-2 p-2 hover:bg-[#106E69] hover:text-white transition-all rounded-md" 
                            href="/industri">
                            <div className="bg-gray-200 p-1 rounded-md group-hover:bg-white">
                                <Icons.Building2 strokeWidth={1.5} className="text-gray-500 group-hover:text-[#106E69] transition-colors"/> 
                            </div>
                            <span className="font-semibold text-sm group-hover:text-white transition-colors">Industri</span> 
                        </Link>
                    </li>
                    <li>
                        <Link className="flex items-center group space-x-2 p-2 hover:bg-[#106E69] hover:text-white transition-all rounded-md" 
                            href="/formulir">
                            <div className="bg-gray-200 p-1 rounded-md group-hover:bg-white">
                                <Icons.ScrollText strokeWidth={1.5} className="text-gray-500 group-hover:text-[#106E69] transition-colors"/> 
                            </div>
                            <span className="font-semibold text-sm group-hover:text-white transition-colors">Formulir PKL</span> 
                        </Link>
                    </li>
                </ul>
                <div className="flex absolute w-full bottom-0 left-0 right-0 p-2 items-center justify-between mt-4">
                    <Button
                        onClick={() => router.post(route('logout'))}
                        className="w-full flex text-sm items-center justify-center space-x-2 p-2 mt-6 bg-[#106E69] text-white rounded-md hover:bg-[#0d5955] cursor-pointer transition-all font-semibold"
                    >
                        <Icons.LogOut strokeWidth={1.5} className="mr-2" />
                        <span>Keluar</span>
                    </Button>
                </div>
        </aside>
    );
}

const MobileSidebar = () => {
    const [accordionValue, setAccordionValue] = useState<string>(() => {
        if (typeof window !== 'undefined') {
            return localStorage.getItem('sidebarAccordion') || '';
        }
        return '';
    });

    const handleAccordionChange = (value: string) => {
        setAccordionValue(value);
        localStorage.setItem('sidebarAccordion', value);
    };

    return (
        <Sheet>
        <SheetTrigger className="text-black cursor-pointer focus:outline-none sm:hidden block">
            <Icons.AlignJustify/>
        </SheetTrigger>
        <SheetContent side="left">
            <SheetHeader>
            <SheetTitle>
                <Link href="/dashboard">
                    <img src="/tes.png" className="w-50" alt="" />
                </Link>
                <Separator className="my-2"/>
            </SheetTitle>
            <h2 className="text-[#6E6E6E] font-semibold">Menu</h2>
                <ul className="text-black space-y-3">
                    <li>
                        <Link className="flex items-center group space-x-2 p-2 hover:bg-[#106E69] hover:text-white transition-all rounded-md" 
                            href="/dashboard">
                            <Icons.Home strokeWidth={1.5} className="text-gray-500 group-hover:text-white transition-colors" /> 
                            <span className="font-semibold text-sm group-hover:text-white transition-colors">Dashboard</span> 
                        </Link>
                    </li>
                    <li>
                        <Accordion 
                            type="single" 
                            collapsible
                            value={accordionValue}
                            onValueChange={handleAccordionChange}
                        >
                        <AccordionItem value="item-1">
                            <AccordionTrigger className="group hover:bg-[#106E69] transition-all">
                                <div className="flex items-center space-x-2 p-2">
                                    <Icons.User strokeWidth={1.5} className="text-gray-500 group-hover:text-white transition-colors" /> 
                                    <span className="font-semibold text-sm group-hover:text-white transition-colors">Guru & Siswa</span> 
                                </div>
                            </AccordionTrigger>
                            <AccordionContent>
                                <Link className="flex items-center justify-between mt-2 space-x-2 p-2 ml-4 hover:bg-gray-200 hover:text-black transition-all rounded-md" 
                                    href="/guru-pembimbing">
                                    <div className="w-full flex items-center space-x-2">
                                        <Icons.Presentation strokeWidth={1.5}/> 
                                        <span className="font-normal text-sm">Pembimbing</span> 
                                    </div>
                                    <Badge variant="jumlah">23</Badge>
                                </Link>
                                <Link className="flex items-center mt-2 space-x-2 p-2 ml-4 hover:bg-gray-200 hover:text-black transition-all rounded-md" 
                                    href="/siswa">
                                    <div className="w-full flex items-center space-x-2">
                                        <Icons.GraduationCap strokeWidth={1.5}/> 
                                        <span className="font-normal text-sm">Siswa</span>  
                                    </div>
                                    <Badge variant="jumlah">100</Badge>
                                </Link>
                            </AccordionContent>
                        </AccordionItem>
                        </Accordion>

                    </li>
                    <li>
                        <Link className="flex items-center group space-x-2 p-2 hover:bg-[#106E69] hover:text-white transition-all rounded-md" 
                            href="/industri">
                            <Icons.Factory strokeWidth={1.5} className="text-gray-500 group-hover:text-white transition-colors"/> 
                            <span className="font-semibold text-sm group-hover:text-white transition-colors">Industri</span> 
                        </Link>
                    </li>
                    <li>
                        <Link className="flex items-center group space-x-2 p-2 hover:bg-[#106E69] hover:text-white transition-all rounded-md" 
                            href="/formulir">
                            <Icons.ScrollText strokeWidth={1.5} className="text-gray-500 group-hover:text-white transition-colors"/> 
                            <span className="font-semibold text-sm group-hover:text-white transition-colors">Formulir PKL</span> 
                        </Link>
                    </li>
                </ul>
                <div className="flex absolute w-full bottom-0 left-0 right-0 p-2 items-center justify-between mt-4">
                    <Button
                        onClick={() => router.post(route('logout'))}
                        className="w-full flex text-sm items-center justify-center space-x-2 p-2 mt-6 bg-[#106E69] text-white rounded-md hover:bg-[#0d5955] cursor-pointer transition-all font-semibold"
                    >
                        <Icons.LogOut strokeWidth={1.5} className="mr-2" />
                        <span>Keluar</span>
                    </Button>

                </div>
            </SheetHeader>
        </SheetContent>
        </Sheet>

    );
}
export { Sidebar, MobileSidebar};
