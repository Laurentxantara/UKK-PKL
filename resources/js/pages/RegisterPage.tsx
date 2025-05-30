import stembayo from '../../assets/logo/stembayo.webp';
import { Input } from '@/components/ui/input';
import FadeSwiper from '@/components/used/carousel';
import * as Lucide from 'lucide-react';
import { Button } from '@/components/ui/button';    
import { Checkbox } from '@/components/ui/checkbox';
import { FormEventHandler } from 'react';
import { Link } from '@inertiajs/react';
import { Head, useForm } from '@inertiajs/react';
import InputError from '@/components/input-error';


type RegisterForm = {
    name: string;
    email: string;
    password: string;
    password_confirmation: string;
};

export default function LoginPage() {
   const { data, setData, post, processing, errors, reset } = useForm<Required<RegisterForm>>({
           name: '',
           email: '',
           password: '',
           password_confirmation: '',
       });
   
       const submit: FormEventHandler = (e) => {
           e.preventDefault();
           post(route('register'), {
               onFinish: () => reset('password', 'password_confirmation'),
           });
       };

    return (
    <>
    <Head title="Register" />
    <div className="grid grid-cols-1 lg:grid-cols-[1.5fr_1fr] w-full bg-[#02423F]">
        <div className="relative w-full h-40 md:h-screen overflow-hidden">
            <FadeSwiper/>
            <div className='absolute z-20 top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 flex flex-col items-center justify-center pointer-events-none'>
                <img src={stembayo} alt="" draggable="false" className='w-20 md:w-50' />
                <h1 className='text-xs md:text-2xl font-bold text-center px-4 w-full'>Manajemen Praktek Kerja Lapangan SMKN 2 Depok</h1>
            </div>
        </div>
        <div className='bg-white w-full  p-10 h-screen relative overflow-hidden flex flex-col items-center md:justify-center space-y-10 md:space-y-20  md:rounded-none'>
            <div className='flex flex-col items-center justify-center'>
            <h1 className='text-[#106E69] font-bold text-3xl md:text-4xl'>Selamat Datang!</h1>
            <p className='text-black text-sm text-center'>Harap Mengisi Data dengan benar</p>
            </div>
            <form className='flex flex-col space-y-4 md:space-y-8' onSubmit={submit}>
            <div className='flex flex-col items-center justify-center space-y-7 relative'>

                <div>
                    <div className='relative flex flex-col items-center justify-center'>
                            <span>
                                <Lucide.User strokeWidth={1.5} className='absolute left-2 top-1/2 transform -translate-y-1/2 text-[#106E69]' />
                            </span>
                            <Input 
                                className="w-72 md:w-80 pl-10 py-5 text-black" 
                                id="name"
                                type="text"
                                required
                                autoFocus
                                tabIndex={1}
                                autoComplete="name"
                                value={data.name}
                                onChange={(e) => setData('name', e.target.value)}
                                disabled={processing}
                                placeholder="Username"
                                />
                    </div>
                        <InputError message={errors.name} className="mt-2" />
                </div>

                <div>
                <div className='relative flex flex-col items-center justify-center'>
                        <span>
                            <Lucide.Mail strokeWidth={1.5} className='absolute left-2 top-1/2 transform -translate-y-1/2 text-[#106E69]' />
                        </span>
                        <Input 
                            className="w-72 md:w-80 pl-10 py-5 text-black" 
                            id="email"
                            type="email"
                            required
                            tabIndex={2}
                            autoComplete="email"
                            value={data.email}
                            onChange={(e) => setData('email', e.target.value)}
                            disabled={processing}
                            placeholder="Email"
                            />
                </div>
                    <InputError message={errors.email} />
                </div>
                <div>

                    <div className='relative flex flex-col items-center justify-center'>
                        <span>
                            <Lucide.KeyRound strokeWidth={1.5} className='absolute left-2 top-1/2 transform -translate-y-1/2 text-[#106E69]' />
                        </span>
                        <Input 
                            className="w-72 md:w-80 pl-10 py-5 text-black" 
                            id="password"
                            type="password"
                            required
                            tabIndex={2}
                            autoComplete="current-password"
                            value={data.password}
                            onChange={(e) => setData('password', e.target.value)}
                            placeholder="Password"
                            />
                    </div>
                        <InputError message={errors.password} />
                </div>

                <div>
                    <div className='relative flex flex-col items-center justify-center'>
                        <span>
                            <Lucide.KeyRound strokeWidth={1.5} className='absolute left-2 top-1/2 transform -translate-y-1/2 text-[#106E69]' />
                        </span>
                        <Input 
                            className="w-72 md:w-80 pl-10 py-5 text-black" 
                            id="password_confirmation"
                            type="password"
                            required
                            tabIndex={4}
                            autoComplete="new-password"
                            value={data.password_confirmation}
                            onChange={(e) => setData('password_confirmation', e.target.value)}
                            disabled={processing}
                            placeholder="Confirm password"
                            />
                    </div>
                        <InputError message={errors.password_confirmation} />
                </div>

                    {/* <div className='absolute right-0 bottom-0 '>
                        <label className='text-sm text-black flex items-center space-x-2 cursor-pointer select-none'>
                            <Checkbox />
                            <span>Show Password</span>
                        </label>
                    </div> */}
                </div>
                    <div className='space-y-2'>
                        <Button 
                        className='w-full'
                        variant='hijau'
                        size='default'
                        >
                            Daftar
                        </Button>
                         <div className='flex items-center justify-center space-x-1'>
                            <span className='text-black text-sm'>Sudah punya akun?</span>
                                <Link href={route('login')} className='text-[#106E69] text-sm hover:underline'>Login</Link>    
                            <span className='text-black text-sm'>Sekarang!</span>
                        </div>
                    </div>
                </form>
                <div className='absolute bottom-0 w-full'>
                <div className='relative w-full h-25'>
                    <svg
                        className="absolute bottom-0 w-full h-full z-10"
                        viewBox="0 0 500 150"
                        preserveAspectRatio="none"
                        >
                        <path
                        d="M0.00,49.98 C150.00,150.00 349.61,-49.98 500.00,49.98 L500.00,150.00 L0.00,150.00 Z"
                        className="fill-[#9ABCBA]"
                        >

                        </path>
                    </svg>
                    <svg
                        className="absolute bottom-0 w-full h-full z-20"
                        viewBox="0 0 1440 320"
                        preserveAspectRatio="none"
                        >
                        <path
                        d="M0,256L48,245.3C96,235,192,213,288,186.7C384,160,480,128,576,117.3C672,107,768,117,864,133.3C960,149,1056,171,1152,160C1248,149,1344,107,1392,85.3L1440,64L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"
                        className="fill-[#CEDFDE]"
                        ></path>
                    </svg>
                </div>
                </div>
        </div>
    </div>
    </>







    );
}
