@props(['step' => 1])
<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
    <div>
        @isset($logo)
            {{ $logo }}
        @else
            <Link href="/">
                <SvgLogo height="h-20" />
            </Link>
        @endisset
    </div>

    <div class="w-full sm:max-w-6xl mt-6 px-6 py-4 bg-white bg-opacity-80 shadow-md overflow-hidden sm:rounded-lg dark:bg-zinc-800 dark:bg-opacity-80">
        <div class="">
            <nav class="mx-auto" aria-label="Progress">
                <ol role="list" class="overflow-hidden rounded-md lg:flex lg:rounded-xl lg:border lg:border-gray-300">
                    <li class="relative overflow-hidden lg:flex-1">
                        <div class="overflow-hidden border border-gray-200 rounded-t-md border-b-0 lg:border-0">
                            @if($step == 1)
                                <a aria-current="step">
                                    <span class="absolute left-0 top-0 h-full w-1 bg-green-500 lg:bottom-0 lg:top-auto lg:h-1 lg:w-full" aria-hidden="true"></span>
                                    <span class="flex items-start px-6 py-5 text-sm font-medium lg:pl-9">
              <span class="flex-shrink-0">
                <span class="flex h-10 w-10 items-center justify-center rounded-full border-2 border-green-500">
                  <span class="text-green-500">01</span>
                </span>
              </span>
              <span class="ml-4 mt-0.5 flex min-w-0 flex-col">
                <span class="text-lg font-medium text-green-500">{{ __('Installation protocol') }}</span>
                <span class="text-sm font-medium text-gray-500 dark:text-gray-200">{{ __('Read the protocol and check the environment') }}</span>
              </span>
            </span>
                                </a>
                            @else
                                <a  class="group">
                                    <span class="absolute left-0 top-0 h-full w-1 bg-transparent group-hover:bg-gray-200 lg:bottom-0 lg:top-auto lg:h-1 lg:w-full" aria-hidden="true"></span>
                                    <span class="flex items-start px-6 py-5 text-sm font-medium">
              <span class="flex-shrink-0">
                <span class="flex h-10 w-10 items-center justify-center rounded-full bg-green-500">
                  <svg class="h-6 w-6 text-white" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M19.916 4.626a.75.75 0 01.208 1.04l-9 13.5a.75.75 0 01-1.154.114l-6-6a.75.75 0 011.06-1.06l5.353 5.353 8.493-12.739a.75.75 0 011.04-.208z" clip-rule="evenodd" />
                  </svg>
                </span>
              </span>
              <span class="ml-4 mt-0.5 flex min-w-0 flex-col">
                <span class="text-base font-medium dark:text-gray-200">{{ __('Installation protocol') }}</span>
                <span class="text-sm font-medium text-gray-500 dark:text-gray-200">{{ __('Read the protocol and check the environment') }}</span>
              </span>
            </span>
                                </a>
                            @endif
                        </div>
                    </li>
                    <li class="relative overflow-hidden lg:flex-1">
                        <div class="overflow-hidden border border-gray-200 lg:border-0">
                            <!-- Current Step -->
                            @if($step == 2)
                                <a  aria-current="step">
                                    <span class="absolute left-0 top-0 h-full w-1 bg-green-500 lg:bottom-0 lg:top-auto lg:h-1 lg:w-full" aria-hidden="true"></span>
                                    <span class="flex items-start px-6 py-5 text-sm font-medium lg:pl-9">
              <span class="flex-shrink-0">
                <span class="flex h-10 w-10 items-center justify-center rounded-full border-2 border-green-500">
                  <span class="text-green-500">02</span>
                </span>
              </span>
              <span class="ml-4 mt-0.5 flex min-w-0 flex-col">
                <span class="text-lg font-medium text-green-500">{{ __('Config information') }}</span>
                <span class="text-sm font-medium text-gray-500 dark:text-gray-200">{{ __('Database and website basic information') }}</span>
              </span>
            </span>
                                </a>
                            @elseif($step < 2)
                                <a  class="group">
                                    <span class="absolute left-0 top-0 h-full w-1 bg-transparent group-hover:bg-gray-200 lg:bottom-0 lg:top-auto lg:h-1 lg:w-full" aria-hidden="true"></span>
                                    <span class="flex items-start px-6 py-5 text-sm font-medium lg:pl-9">
              <span class="flex-shrink-0">
                <span class="flex h-10 w-10 items-center justify-center rounded-full border-2 border-gray-300">
                  <span class="text-gray-500 dark:text-gray-200">02</span>
                </span>
              </span>
              <span class="ml-4 mt-0.5 flex min-w-0 flex-col">
                <span class="text-base font-medium text-gray-500 dark:text-gray-200">{{ __('Config information') }}</span>
                <span class="text-sm font-medium text-gray-500 dark:text-gray-200">{{ __('Database and website basic information') }}</span>
              </span>
            </span>
                                </a>
                            @else
                                <a  class="group">
                                    <span class="absolute left-0 top-0 h-full w-1 bg-transparent group-hover:bg-gray-200 lg:bottom-0 lg:top-auto lg:h-1 lg:w-full" aria-hidden="true"></span>
                                    <span class="flex items-start px-6 py-5 text-sm font-medium">
              <span class="flex-shrink-0">
                <span class="flex h-10 w-10 items-center justify-center rounded-full bg-green-500">
                  <svg class="h-6 w-6 text-white" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M19.916 4.626a.75.75 0 01.208 1.04l-9 13.5a.75.75 0 01-1.154.114l-6-6a.75.75 0 011.06-1.06l5.353 5.353 8.493-12.739a.75.75 0 011.04-.208z" clip-rule="evenodd" />
                  </svg>
                </span>
              </span>
              <span class="ml-4 mt-0.5 flex min-w-0 flex-col">
                <span class="text-base font-medium dark:text-gray-200">{{ __('Config information') }}</span>
                <span class="text-sm font-medium text-gray-500 dark:text-gray-200">{{ __('Database and website basic information') }}</span>
              </span>
            </span>
                                </a>
                            @endif
                            <!-- Separator -->
                            <div class="absolute inset-0 left-0 top-0 hidden w-3 lg:block" aria-hidden="true">
                                <svg class="h-full w-full text-gray-300" viewBox="0 0 12 82" fill="none" preserveAspectRatio="none">
                                    <path d="M0.5 0V31L10.5 41L0.5 51V82" stroke="currentcolor" vector-effect="non-scaling-stroke" />
                                </svg>
                            </div>
                        </div>
                    </li>
                    <li class="relative overflow-hidden lg:flex-1">
                        <div class="overflow-hidden border border-gray-200 lg:border-0">
                            <!-- Current Step -->
                            @if($step == 3)
                                <a  aria-current="step">
                                    <span class="absolute left-0 top-0 h-full w-1 bg-green-500 lg:bottom-0 lg:top-auto lg:h-1 lg:w-full" aria-hidden="true"></span>
                                    <span class="flex items-start px-6 py-5 text-sm font-medium lg:pl-9">
              <span class="flex-shrink-0">
                <span class="flex h-10 w-10 items-center justify-center rounded-full border-2 border-green-500">
                  <span class="text-green-500">03</span>
                </span>
              </span>
              <span class="ml-4 mt-0.5 flex min-w-0 flex-col">
                <span class="text-lg font-medium text-green-500">{{ __('Create data') }}</span>
                <span class="text-sm font-medium text-gray-500 dark:text-gray-200">{{ __('Create data tables and administrators') }}</span>
              </span>
            </span>
                                </a>
                            @elseif($step < 3)
                                <a  class="group">
                                    <span class="absolute left-0 top-0 h-full w-1 bg-transparent group-hover:bg-gray-200 lg:bottom-0 lg:top-auto lg:h-1 lg:w-full" aria-hidden="true"></span>
                                    <span class="flex items-start px-6 py-5 text-sm font-medium lg:pl-9">
              <span class="flex-shrink-0">
                <span class="flex h-10 w-10 items-center justify-center rounded-full border-2 border-gray-300">
                  <span class="text-gray-500 dark:text-gray-200">03</span>
                </span>
              </span>
              <span class="ml-4 mt-0.5 flex min-w-0 flex-col">
                <span class="text-base font-medium text-gray-500 dark:text-gray-200">{{ __('Create data') }}</span>
                <span class="text-sm font-medium text-gray-500 dark:text-gray-200">{{ __('Create data tables and administrators') }}</span>
              </span>
            </span>
                                </a>
                            @else
                                <a  class="group">
                                    <span class="absolute left-0 top-0 h-full w-1 bg-transparent group-hover:bg-gray-200 lg:bottom-0 lg:top-auto lg:h-1 lg:w-full" aria-hidden="true"></span>
                                    <span class="flex items-start px-6 py-5 text-sm font-medium">
              <span class="flex-shrink-0">
                <span class="flex h-10 w-10 items-center justify-center rounded-full bg-green-500">
                  <svg class="h-6 w-6 text-white" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M19.916 4.626a.75.75 0 01.208 1.04l-9 13.5a.75.75 0 01-1.154.114l-6-6a.75.75 0 011.06-1.06l5.353 5.353 8.493-12.739a.75.75 0 011.04-.208z" clip-rule="evenodd" />
                  </svg>
                </span>
              </span>
              <span class="ml-4 mt-0.5 flex min-w-0 flex-col">
                <span class="text-base font-medium dark:text-gray-200">{{ __('Create data') }}</span>
                <span class="text-sm font-medium text-gray-500 dark:text-gray-200">{{ __('Create data tables and administrators') }}</span>
              </span>
            </span>
                                </a>
                            @endif
                            <!-- Separator -->
                            <div class="absolute inset-0 left-0 top-0 hidden w-3 lg:block" aria-hidden="true">
                                <svg class="h-full w-full text-gray-300" viewBox="0 0 12 82" fill="none" preserveAspectRatio="none">
                                    <path d="M0.5 0V31L10.5 41L0.5 51V82" stroke="currentcolor" vector-effect="non-scaling-stroke" />
                                </svg>
                            </div>
                        </div>
                    </li>
                    <li class="relative overflow-hidden lg:flex-1">
                        <div class="overflow-hidden border border-gray-200 rounded-b-md border-t-0 lg:border-0">
                            @if($step < 4)
                                <a  class="group">
                                    <span class="absolute left-0 top-0 h-full w-1 bg-transparent group-hover:bg-gray-200 lg:bottom-0 lg:top-auto lg:h-1 lg:w-full" aria-hidden="true"></span>
                                    <span class="flex items-start px-6 py-5 text-sm font-medium lg:pl-9">
              <span class="flex-shrink-0">
                <span class="flex h-10 w-10 items-center justify-center rounded-full border-2 border-gray-300">
                  <span class="text-gray-500 dark:text-gray-200">04</span>
                </span>
              </span>
              <span class="ml-4 mt-0.5 flex min-w-0 flex-col">
                <span class="text-base font-medium text-gray-500 dark:text-gray-200">{{ __('Successful installation') }}</span>
                <span class="text-sm font-medium text-gray-500 dark:text-gray-200">{{ __('The system has been installed') }}</span>
              </span>
            </span>
                                </a>
                            @else
                                <a  class="group">
                                    <span class="absolute left-0 top-0 h-full w-1 bg-transparent group-hover:bg-gray-200 lg:bottom-0 lg:top-auto lg:h-1 lg:w-full" aria-hidden="true"></span>
                                    <span class="flex items-start px-6 py-5 text-sm font-medium">
              <span class="flex-shrink-0">
                <span class="flex h-10 w-10 items-center justify-center rounded-full bg-green-500">
                  <svg class="h-6 w-6 text-white" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M19.916 4.626a.75.75 0 01.208 1.04l-9 13.5a.75.75 0 01-1.154.114l-6-6a.75.75 0 011.06-1.06l5.353 5.353 8.493-12.739a.75.75 0 011.04-.208z" clip-rule="evenodd" />
                  </svg>
                </span>
              </span>
              <span class="ml-4 mt-0.5 flex min-w-0 flex-col">
                <span class="text-base font-medium text-green-500">{{ __('Successful installation') }}</span>
                <span class="text-sm font-medium text-gray-500 dark:text-gray-200">{{ __('The system has been installed') }}</span>
              </span>
            </span>
                                </a>
                            @endif
                            <!-- Separator -->
                            <div class="absolute inset-0 left-0 top-0 hidden w-3 lg:block" aria-hidden="true">
                                <svg class="h-full w-full text-gray-300" viewBox="0 0 12 82" fill="none" preserveAspectRatio="none">
                                    <path d="M0.5 0V31L10.5 41L0.5 51V82" stroke="currentcolor" vector-effect="non-scaling-stroke" />
                                </svg>
                            </div>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>
        <main class="max-h-[700px] overflow-y-auto mt-4">
            {{ $slot }}
        </main>
    </div>
</div>
